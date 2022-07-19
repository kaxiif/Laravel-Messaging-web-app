<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/', [MessageController::class, 'index'])->name('messages.index');
Route::resource('/', MessageController::class);
Route::get('/send', [MessageController::class, 'send'])->name('send');
Route::get('/create/{id?}/{subject?}', [MessageController::class, 'create'])->name('create');
Route::get('/sent', [MessageController::class, 'sent'])->name('sent-messages');
Route::get('/read/{id}', [MessageController::class, 'read'])->name('read');
Route::get('/delete/{id}', [MessageController::class, 'delete'])->name('delete');
Route::get('/deleted', [MessageController::class, 'deleted'])->name('deleted');
Route::get('/return/{id}', [MessageController::class, 'return'])->name('return');



Auth::routes();

Route::get('/home', [MessageController::class, 'index'])->name('messages.index');

