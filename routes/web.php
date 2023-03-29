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

Route::get('/contacts', [App\Http\Controllers\ContactsController::class, 'index'])->name('index');
Route::get('/contacts/create', [App\Http\Controllers\ContactsController::class, 'create'])->name('create');
Route::post('/contacts/store', [App\Http\Controllers\ContactsController::class, 'store'])->name('store');
Route::delete('/contacts/destroy/{id}', [App\Http\Controllers\ContactsController::class, 'destroy'])->name('destroy');
Route::get('/contacts/edit/{id}', [App\Http\Controllers\ContactsController::class, 'edit'])->name('edit');
Route::put('/contacts/update/{id}', [App\Http\Controllers\ContactsController::class, 'update'])->name('update');