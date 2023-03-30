<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'contacts'],function(){
    Route::get('/',[ContactsController::class,'getContactsData']);
    Route::get('/create',[ContactsController::class,'createPage']);
    Route::get('/create-contacts',[ContactsController::class,'createContacts']);
    Route::get('/info/{id}',[ContactsController::class,'contactInfo']);
    Route::get('/update',[ContactsController::class,'updateContacts']);
    Route::get('/delete/{id}',[ContactsController::class,'deleteContacts']);
});
