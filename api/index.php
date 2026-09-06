<?php

// Turn off display of PHP notices/warnings in production output
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

date_default_timezone_set('Asia/Jakarta');
putenv('APP_TIMEZONE=Asia/Jakarta');
$_ENV['APP_TIMEZONE'] = 'Asia/Jakarta';
$_SERVER['APP_TIMEZONE'] = 'Asia/Jakarta';

// Forward request to Laravel public/index.php for Vercel Serverless Function
require __DIR__ . '/../public/index.php';
