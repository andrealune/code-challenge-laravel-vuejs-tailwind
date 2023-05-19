<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ContactController};

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
    return view('auth.register');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [ContactController::class,'index'])->name('dashboard');

    Route::resource('/contact', ContactController::class)->parameter("contact","id");
});
require __DIR__.'/auth.php';
