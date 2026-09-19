<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;
use ZipArchive;

class DeployController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $expected = (string) env('DEPLOY_TOKEN', '');
        $provided = (string) $request->header('X-Deploy-Token', '');

        if ($expected === '' || ! hash_equals($expected, $provided)) {
            return response("Forbidden\n", 403)->header('Content-Type', 'text/plain');
        }

        $tmpZip = tempnam(sys_get_temp_dir(), 'shrine-zip-');
        $extractTo = sys_get_temp_dir().'/shrine-extract-'.bin2hex(random_bytes(8));

        try {
            if ($request->filled('download_url')) {
                $downloaded = $this->downloadRelease(
                    (string) $request->input('download_url'),
                    (string) $request->input('github_token', ''),
                    $tmpZip
                );
                if ($downloaded !== true) {
                    return response($downloaded, 400)->header('Content-Type', 'text/plain');
                }
            } elseif ($request->hasFile('release')) {
                $file = $request->file('release');
                if (! $file->isValid()) {
                    return response("Invalid upload: ".$file->getErrorMessage()."\n", 400)
                        ->header('Content-Type', 'text/plain');
                }
                if (! @copy($file->getRealPath(), $tmpZip)) {
                    return response("Could not store upload\n", 500)->header('Content-Type', 'text/plain');
                }
            } else {
                return response("Missing release zip\n", 400)->header('Content-Type', 'text/plain');
            }

            if (! is_dir($extractTo) && ! mkdir($extractTo, 0755, true)) {
                return response("Could not create extract dir\n", 500)->header('Content-Type', 'text/plain');
            }

            $zip = new ZipArchive();
            if ($zip->open($tmpZip) !== true) {
                return response("Invalid zip\n", 400)->header('Content-Type', 'text/plain');
            }
            $zip->extractTo($extractTo);
            $zip->close();

            $source = $extractTo;
            $entries = array_values(array_filter(scandir($extractTo) ?: [], fn ($e) => $e !== '.' && $e !== '..'));
            if (count($entries) === 1 && is_dir($extractTo.'/'.$entries[0])) {
                $source = $extractTo.'/'.$entries[0];
            }

            try {
                $copied = $this->copyReleaseFiles($source, base_path());
                $copied += $this->mirrorSharedHostingAssets(base_path());
            } catch (\Throwable $e) {
                return response('Copy failed: '.$e->getMessage()."\n", 500)->header('Content-Type', 'text/plain');
            }

            return response("OK deployed {$copied} files\n", 200)->header('Content-Type', 'text/plain');
        } finally {
            @unlink($tmpZip);
            $this->deleteDirectory($extractTo);
        }
    }

    /**
     * Shared hosts often use the Laravel app root as the web root.
     * Mirror public/css → css so /css/shrine-theme.css resolves like /images does.
     */
    private function mirrorSharedHostingAssets(string $root): int
    {
        $copied = 0;
        $pairs = [
            'public/css' => 'css',
        ];

        foreach ($pairs as $from => $to) {
            $srcDir = $root.'/'.$from;
            $dstDir = $root.'/'.$to;
            if (! is_dir($srcDir)) {
                continue;
            }
            if (! is_dir($dstDir) && ! mkdir($dstDir, 0755, true)) {
                throw new \RuntimeException("Could not create {$to}");
            }

            foreach (scandir($srcDir) ?: [] as $entry) {
                if ($entry === '.' || $entry === '..') {
                    continue;
                }
                $src = $srcDir.'/'.$entry;
                if (! is_file($src)) {
                    continue;
                }
                $dst = $dstDir.'/'.$entry;
                if (! copy($src, $dst)) {
                    throw new \RuntimeException("Failed mirroring {$to}/{$entry}");
                }
                $copied++;
            }
        }

        return $copied;
    }

    /**
     * @return true|string True on success, error message on failure.
     */
    private function downloadRelease(string $url, string $githubToken, string $destination): bool|string
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return "Invalid download_url\n";
        }

        $host = parse_url($url, PHP_URL_HOST) ?: '';
        $allowed = ['api.github.com', 'github.com', 'objects.githubusercontent.com', 'release-assets.githubusercontent.com'];
        if (! in_array($host, $allowed, true)) {
            return "download_url host not allowed\n";
        }

        if (! function_exists('curl_init')) {
            return "curl extension required\n";
        }

        $fh = fopen($destination, 'w');
        if ($fh === false) {
            return "Could not open temp file\n";
        }

        $ch = curl_init($url);
        $headers = [
            'User-Agent: IdaikatturShrine-Deploy/1.0',
            'Accept: application/octet-stream',
        ];
        if ($githubToken !== '') {
            $headers[] = 'Authorization: Bearer '.$githubToken;
            $headers[] = 'X-GitHub-Api-Version: 2022-11-28';
        }

        curl_setopt_array($ch, [
            CURLOPT_FILE => $fh,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 600,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_FAILONERROR => false,
        ]);

        $ok = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        fclose($fh);

        if ($ok === false) {
            @unlink($destination);

            return "Download failed: {$error}\n";
        }

        if ($status < 200 || $status >= 300) {
            @unlink($destination);

            return "Download HTTP {$status}\n";
        }

        if (! is_file($destination) || filesize($destination) < 100) {
            @unlink($destination);

            return "Downloaded file empty\n";
        }

        return true;
    }

    private function copyReleaseFiles(string $source, string $root): int
    {
        $skip = [
            '.env' => true,
            '.env.production' => true,
            '.env.backup' => true,
        ];

        $copied = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $relative = str_replace('\\', '/', substr($item->getPathname(), strlen($source) + 1));
            if ($relative === '' || isset($skip[$relative])) {
                continue;
            }
            if (str_starts_with($relative, 'storage/app/')
                || str_starts_with($relative, 'storage/logs/')
                || str_starts_with($relative, 'storage/framework/')) {
                continue;
            }

            $target = $root.'/'.$relative;
            if ($item->isDir()) {
                if (! is_dir($target)) {
                    mkdir($target, 0755, true);
                }
                continue;
            }

            $dir = dirname($target);
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if (! copy($item->getPathname(), $target)) {
                throw new \RuntimeException("Failed copying {$relative}");
            }
            $copied++;
        }

        return $copied;
    }

    private function deleteDirectory(string $dir): void
    {
        if (! is_dir($dir)) {
            return;
        }
        foreach (scandir($dir) ?: [] as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            $path = $dir.'/'.$entry;
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                @unlink($path);
            }
        }
        @rmdir($dir);
    }
}
