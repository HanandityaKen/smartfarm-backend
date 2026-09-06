<?php

// Ensure writable storage directory for Vercel Serverless Function
$storagePath = sys_get_temp_dir() . '/storage';
if (!is_dir($storagePath)) {
    @mkdir($storagePath . '/framework/views', 0777, true);
    @mkdir($storagePath . '/framework/sessions', 0777, true);
    @mkdir($storagePath . '/framework/cache/data', 0777, true);
    @mkdir($storagePath . '/logs', 0777, true);
}

// Force valid APP_TIMEZONE
$_ENV['APP_TIMEZONE'] = 'Asia/Jakarta';
$_SERVER['APP_TIMEZONE'] = 'Asia/Jakarta';
putenv('APP_TIMEZONE=Asia/Jakarta');
date_default_timezone_set('Asia/Jakarta');

// Forward request to Laravel public/index.php for Vercel Serverless Function
require __DIR__ . '/../public/index.php';
