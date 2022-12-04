<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/users',[ChatController::class,'users'])->middleware(['auth'])->name('users');
Route::get('/inbox',[ChatController::class,'inbox'])->middleware(['auth'])->name('inbox');
Route::get('/archive',[ChatController::class,'archive'])->middleware(['auth'])->name('archive');
Route::get('/chat/{id}',[ChatController::class,'chat'])->middleware(['auth'])->name('chat');
Route::get('/send/',[ChatController::class,'send'])->middleware(['auth'])->name('send');
Route::get('/archive/{id}',[ChatController::class,'archived'])->middleware(['auth'])->name('archived');
Route::get('/unarchive/{id}',[ChatController::class,'unarchived'])->middleware(['auth'])->name('unarchived');
Route::get('/delete/{id}',[ChatController::class,'delete'])->middleware(['auth'])->name('delete');
Route::post('/avatar-update', [ChatController::class, 'avatar_update'])->name('avatar_update');
