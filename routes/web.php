<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EraserController;
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

Route::get('/',[EraserController::class,'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('nuevo',function(){
    return view('nuevo');
});

Route::get('/contrato', function () {
    return view('contratoPerfil');
})->name("contratoPerfil");

Route::get('template',function(){
    return view('template');
});