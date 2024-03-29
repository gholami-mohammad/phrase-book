<?php

use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\BasicInfoController;
use App\Http\Controllers\GoogleTranslateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/whoami', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/basic-info', [BasicInfoController::class, 'basicInfo']);
Route::middleware('auth:sanctum')->get('/third-party-translator/google', [GoogleTranslateController::class, 'translate']);

Route::middleware('auth:sanctum')->prefix('words')->group(function () {
    Route::get('/', [WordController::class, 'index']);
    Route::post('/', [WordController::class, 'store']);
    Route::post('/{word}', [WordController::class, 'update']);
    Route::get('/{word}', [WordController::class, 'show']);
    Route::delete('/{word}', [WordController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/translations')->group(function () {
    Route::get('/', [TranslationController::class, 'index']);
    Route::post('/', [TranslationController::class, 'store']);
    Route::post('/{translation}', [TranslationController::class, 'update']);
    Route::get('/{translation}', [TranslationController::class, 'show']);
    Route::delete('/{translation}', [TranslationController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/review')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/{word}', [ReviewController::class, 'store']);
});

Route::middleware('auth:sanctum')->prefix('/database-backups')->group(function () {
    Route::get('/', [DatabaseBackupController::class, 'index']);
    Route::get('/take', [DatabaseBackupController::class, 'backup']);
    Route::get('/{name}', [DatabaseBackupController::class, 'download']);
    Route::delete('/{name}', [DatabaseBackupController::class, 'delete']);
});
