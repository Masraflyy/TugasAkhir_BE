<?php

use App\Http\Controllers\Api\KopiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/Frist', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/Welcome', function () {
    return 'Selamat Datang di Kopi Saya Maju 57';
});

Route::get('/Information', function () {
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

Route::get('/kopi', [KopiController::class, 'index']);

Route::post('/kopi', [KopiController::class, 'store']);

Route::get('/kopi/{id}', [KopiController::class, 'show']);

Route::put('/kopi/{id}', [KopiController::class, 'update']);

Route::patch('/kopi/{id}', [KopiController::class, 'update']);

Route::delete('/kopi/{id}', [KopiController::class, 'destroy']);

//jangan lupa follow ig saya buat yang liat ini yaa @rafly_dhana