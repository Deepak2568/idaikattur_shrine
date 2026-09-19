<?php
/**
 * One-time setup (FileZilla):
 * 1. Upload this file to public/ci-deploy.php
 * 2. Add DEPLOY_TOKEN=... to the server .env (long random string)
 * 3. Add the same value as GitHub secret DEPLOY_TOKEN
 * 4. Add GitHub secret DEPLOY_URL=https://YOUR-DOMAIN/ci-deploy.php
 *
 * GitHub Actions will POST a zip here over HTTPS (works on shared hosting).
 */

declare(strict_types=1);

header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method not allowed\n";
    exit;
}

$root = dirname(__DIR__);
$envFile = $root . '/.env';
$expected = '';

if (is_readable($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (str_starts_with($line, 'DEPLOY_TOKEN=')) {
            $expected = trim(substr($line, strlen('DEPLOY_TOKEN=')), " \t\"'");
            break;
        }
    }
}

$provided = $_SERVER['HTTP_X_DEPLOY_TOKEN'] ?? '';

if ($expected === '' || !hash_equals($expected, $provided)) {
    http_response_code(403);
    echo "Forbidden\n";
    exit;
}

if (!isset($_FILES['release']) || !is_uploaded_file($_FILES['release']['tmp_name'])) {
    http_response_code(400);
    echo "Missing release zip\n";
    exit;
}

if (($_FILES['release']['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo "Upload error\n";
    exit;
}

$tmpZip = sys_get_temp_dir() . '/shrine-release-' . bin2hex(random_bytes(8)) . '.zip';
$extractTo = sys_get_temp_dir() . '/shrine-extract-' . bin2hex(random_bytes(8));

if (!move_uploaded_file($_FILES['release']['tmp_name'], $tmpZip)) {
    http_response_code(500);
    echo "Could not store upload\n";
    exit;
}

if (!mkdir($extractTo) && !is_dir($extractTo)) {
    @unlink($tmpZip);
    http_response_code(500);
    echo "Could not create extract dir\n";
    exit;
}

$zip = new ZipArchive();
if ($zip->open($tmpZip) !== true) {
    @unlink($tmpZip);
    http_response_code(400);
    echo "Invalid zip\n";
    exit;
}

$zip->extractTo($extractTo);
$zip->close();
@unlink($tmpZip);

$source = $extractTo;
$entries = array_values(array_filter(scandir($extractTo) ?: [], fn ($e) => $e !== '.' && $e !== '..'));
if (count($entries) === 1 && is_dir($extractTo . '/' . $entries[0])) {
    $source = $extractTo . '/' . $entries[0];
}

$skip = [
    '.env' => true,
    '.env.production' => true,
    '.env.backup' => true,
];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$copied = 0;
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

    $target = $root . '/' . $relative;
    if ($item->isDir()) {
        if (!is_dir($target)) {
            mkdir($target, 0755, true);
        }
        continue;
    }

    $dir = dirname($target);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    if (!copy($item->getPathname(), $target)) {
        http_response_code(500);
        echo "Failed copying {$relative}\n";
        exit;
    }
    $copied++;
}

$cleaner = static function (string $dir) use (&$cleaner): void {
    if (!is_dir($dir)) {
        return;
    }
    foreach (scandir($dir) ?: [] as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $path = $dir . '/' . $entry;
        if (is_dir($path)) {
            $cleaner($path);
        } else {
            @unlink($path);
        }
    }
    @rmdir($dir);
};
$cleaner($extractTo);

echo "OK deployed {$copied} files\n";
