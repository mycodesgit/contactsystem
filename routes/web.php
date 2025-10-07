<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;

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


Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('login');
    });

    Route::get('/login',[LoginController::class,'getLogin'])->name('getLogin');
    Route::post('/login',[LoginController::class,'postLogin'])->name('postLogin');

    Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [LoginController::class, 'postRegister'])->name('postRegister');
});

Route::group(['middleware'=>['login_auth']],function(){
    Route::get('/contact/list',[ContactController::class,'index'])->name('index.contact');
    Route::get('/contact/add',[ContactController::class,'store'])->name('store.contact');
    Route::get('/contact/fetch', [ContactController::class, 'show'])->name('show.contact');
    Route::post('/contact/create',[ContactController::class,'contactCreate'])->name('create.contact');
    Route::get('/contact/edit/{id}', [ContactController::class, 'editContact'])->name('edit.contact');
    Route::put('/contact/update/{id}', [ContactController::class, 'updateContact'])->name('update.contact');
    Route::delete('/contact/delete/{id}', [ContactController::class, 'deleteContact'])->name('delete.contact');


    Route::post('/logout',[ContactController::class,'logout'])->name('logout');
});
