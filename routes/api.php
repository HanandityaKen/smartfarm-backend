<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontrolController;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\LogSuhuController;
use App\Http\Controllers\Api\LogGasController;
use App\Http\Controllers\Api\LogPakanMinumController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk Log Sensor (ESP32 & Vue)
Route::get('/sensor', [SensorController::class, 'getLogs']);
Route::post('/sensor', [SensorController::class, 'storeLog']);

// Route untuk Konfigurasi & Switch Kontrol
Route::get('/konfigurasi', [SensorController::class, 'getConfig']);
Route::put('/konfigurasi', [SensorController::class, 'updateConfig']);

// Route untuk Kontrol Perangkat
Route::get('/kontrol', [KontrolController::class, 'index']);
Route::patch('/kontrol', [KontrolController::class, 'update']);

// Endpoint Telemetri Suhu
Route::get('/telemetri/suhu', [LogSuhuController::class, 'index']);
Route::post('/telemetri/suhu', [LogSuhuController::class, 'store']);

// Endpoint Telemetri Gas
Route::get('/telemetri/gas', [LogGasController::class, 'index']);
Route::post('/telemetri/gas', [LogGasController::class, 'store']);

// Endpoint Telemetri Pakan & Minum
Route::get('/telemetri/pakan-minum', [LogPakanMinumController::class, 'index']);
Route::post('/telemetri/pakan-minum', [LogPakanMinumController::class, 'store']);