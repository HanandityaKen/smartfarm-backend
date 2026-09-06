<?php

try {
    // Ensure writable storage directory for Vercel Serverless Function
    $storagePath = sys_get_temp_dir() . '/storage';

    // Create all required directories FIRST before app boots
    @mkdir($storagePath . '/framework/views', 0777, true);
    @mkdir($storagePath . '/framework/sessions', 0777, true);
    @mkdir($storagePath . '/framework/cache/data', 0777, true);
    @mkdir($storagePath . '/logs', 0777, true);
    @mkdir($storagePath . '/app/public', 0777, true);

    // Set storage-related env vars BEFORE app boots so config/view.php picks them up
    putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
    $_ENV['VIEW_COMPILED_PATH'] = "$storagePath/framework/views";
    $_SERVER['VIEW_COMPILED_PATH'] = "$storagePath/framework/views";

    // Force valid APP_TIMEZONE
    $_ENV['APP_TIMEZONE'] = 'Asia/Jakarta';
    $_SERVER['APP_TIMEZONE'] = 'Asia/Jakarta';
    putenv('APP_TIMEZONE=Asia/Jakarta');
    date_default_timezone_set('Asia/Jakarta');

    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    // Forward request to Laravel public/index.php for Vercel Serverless Function
    require __DIR__ . '/../public/index.php';

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Error Debug</h1>";
    echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
