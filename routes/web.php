<?php

use App\Http\Controllers\ContactController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Contact
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
Route::get('/contact/create',[ContactController::class,'create'])->name('contact.create');
Route::post('/contact',[ContactController::class,'store'])->name('contact.store');
Route::get('/contact/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');
Route::post('/contact/edit/{id}',[ContactController::class,'update'])->name('contact.update');
Route::get('/contact/delete/{id}',[ContactController::class,'destroy'])->name('contact.delete');
