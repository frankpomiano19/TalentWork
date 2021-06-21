<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EraserController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
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



Route::get('/perfilDos',[ContractController::class,'index']);
Route::middleware(['auth'])->group(function () {
    Route::post('/proccessContract',[ContractController::class,'contractProcess'])->name('iPContract');
    Route::post('/registroServTecnico',[ServiceController::class,'registroTecnico'])->name('servicio.tecnico');
    Route::post('/registroServTalento',[ServiceController::class,'registroTalento'])->name('servicio.talento');
});


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
Route::get('registro',function(){
    return view('registro');
});
Route::get('perfil',function(){
    return view('perfil');
});
Route::get('registroServicio',[ServiceController::class, 'registro']);
Route::get('/perfilservicio',function(){
    return view('perfilservicio');
});
Route::get('/servicio',function(){
    return view('servicio');
});
