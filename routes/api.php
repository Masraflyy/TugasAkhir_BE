<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return 'Kak Kopi Susu nya 1 ya';
});

Route::get('/info', function () {
    return response()->json([
        'Nama Cafe' => 'Kopi Saya Maju 57',
        'Buka-Tutup' => '07.00-23.00',
        'Lokasi ' => 'Depan Pintu Surga',
        'Rating ' => '9.9/10',
        'Tahun Berdiri' => '1955',
        'Owner ' => 'Masrafly Ganteng',
        'Fasilitas' => 'Free Wifi, Indoor Ac, 5 Bidadari Cantik , Parkir mobil & motor'
    ]);
});

Route::get('/tasks', [TaskController::class, 'index']);

Route::post('/tasks', [TaskController::class, 'store']);

Route::get('/tasks/{id}', [TaskController::class, 'show']);

Route::put('/tasks/{id}', [TaskController::class, 'update']);

Route::patch('/tasks/{id}', [TaskController::class, 'update']);

Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

