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
        $expected = (string) config('app.deploy_token', env('DEPLOY_TOKEN', ''));
        $provided = (string) $request->header('X-Deploy-Token', '');

        if ($expected === '' || ! hash_equals($expected, $provided)) {
            return response("Forbidden\n", 403)->header('Content-Type', 'text/plain');
        }

        if (! $request->hasFile('release')) {
            return response("Missing release zip\n", 400)->header('Content-Type', 'text/plain');
        }

        $file = $request->file('release');
        if (! $file->isValid()) {
            return response("Invalid upload: ".$file->getErrorMessage()."\n", 400)
                ->header('Content-Type', 'text/plain');
        }

        $tmpZip = tempnam(sys_get_temp_dir(), 'shrine-zip-');
        $extractTo = sys_get_temp_dir().'/shrine-extract-'.bin2hex(random_bytes(8));

        try {
            if (! move_uploaded_file($file->getRealPath(), $tmpZip) && ! @rename($file->getRealPath(), $tmpZip)) {
                @copy($file->getRealPath(), $tmpZip);
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

            $root = base_path();
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
                    return response("Failed copying {$relative}\n", 500)->header('Content-Type', 'text/plain');
                }
                $copied++;
            }

            return response("OK deployed {$copied} files\n", 200)->header('Content-Type', 'text/plain');
        } finally {
            @unlink($tmpZip);
            $this->deleteDirectory($extractTo);
        }
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
