<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('tasks', TaskController::class)
        ->only(['index', 'show', 'update', 'create', 'store', 'destroy']);
    Route::post('upload-file', [FileController::class, 'upload'])->name('upload.file');
    Route::delete('delete-file/{id}', [FileController::class, 'delete'])->name('delete.file');
    Route::get('download/{token}', [FileController::class, 'download'])->name('download.file');
});
