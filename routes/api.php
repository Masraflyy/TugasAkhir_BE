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
        'app' => 'Kopi Susu',
        'version' => '1.0',
        'author' => 'Kopi Mijen',
    ]);
});

Route::get('/tasks', [TaskController::class, 'kopi index']);

Route::post('/tasks', [TaskController::class, 'store']);

Route::get('/tasks/{id}', [TaskController::class, 'show']);

Route::put('/tasks/{id}', [TaskController::class, 'update']);

Route::patch('/tasks/{id}', [TaskController::class, 'update']);

Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

