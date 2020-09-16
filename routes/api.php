<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['as' => 'api.'], function() {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('tasks', [TaskController::class, 'index'])->name('tasks.all');
        Route::post('task', [TaskController::class, 'store'])->name('task.store');
        Route::delete('task/{id}', [TaskController::class, 'destroy'])->name('task.delete');
        Route::get('file/{token}', [FileController::class, 'show'])->name('file.show');
    });
});
