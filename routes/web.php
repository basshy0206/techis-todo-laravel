<?php

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

Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');     //URLとtasksを結びつける。
Route::post('/task', [App\Http\Controllers\TaskController::class, 'store'])->name('task');     //URLとtaskを結びつける。
Route::delete('/task/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('/task/{task}');     //URLとtaskを結びつける。

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
