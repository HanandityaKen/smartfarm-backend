<?php

// Force valid APP_TIMEZONE environment variable for Laravel bootstrap on Vercel
if (empty($_ENV['APP_TIMEZONE']) || $_ENV['APP_TIMEZONE'] === '""' || $_ENV['APP_TIMEZONE'] === "''") {
    $_ENV['APP_TIMEZONE'] = 'Asia/Jakarta';
    $_SERVER['APP_TIMEZONE'] = 'Asia/Jakarta';
    putenv('APP_TIMEZONE=Asia/Jakarta');
}

date_default_timezone_set('Asia/Jakarta');

// Forward request to Laravel public/index.php for Vercel Serverless Function
require __DIR__ . '/../public/index.php';
