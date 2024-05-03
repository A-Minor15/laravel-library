<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function(){
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    // '/' --> root URI (localhost | 127.0.0.1)
});

Route::group(['prefix'=>'author', 'as'=>'author.'], function(){
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::post('/store', [AuthorController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('edit');
    Route::patch('{id}/update', [AuthorController::class, 'update'])->name('update');
    Route::get('{id}/delete', [AuthorController::class, 'delete'])->name('delete');
    Route::delete('{id}/destroy', [AuthorController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix'=>'book', 'as'=>'book.'], function(){
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::post('/store', [BookController::class, 'store'])->name('store');
    Route::get('/show', [BookController::class, 'show'])->name('show');
});

