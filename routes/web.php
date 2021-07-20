<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EraserController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PostCommentController;
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

Route::get('/',[HomeController::class,'showOccupationService'])->name('ServiciosOfrecidos');
Route::get('/talentService',[HomeController::class,'showTalentService'])->name('showTalentService');
Route::get('/occupationService',[HomeController::class,'showOccupationService'])->name('showOccupationService');
Route::get('/profileServiceTalent/{id}',[HomeController::class,'showProfileServiceTalent'])->name('showProfileServiceTalent');
Route::get('/profileServiceOccupation/{id}',[HomeController::class,'showProfileServiceOccupation'])->name('showProfileServiceOccupation');
Route::post('/comment','PostCommentController@newComment')->name('registrarComent');
Route::post('/question','PostCommentController@newQuestion')->name('registrarPreg');

Route::middleware(['auth'])->group(function () {
    Route::post('/proccessContract',[ContractController::class,'contractProcess'])->name('iPContract');
    Route::post('/registroServTecnico',[ServiceController::class,'registroTecnico'])->name('servicio.tecnico');
    Route::post('/registroServTalento',[ServiceController::class,'registroTalento'])->name('servicio.talento');
    Route::get('/perfil/{id}', 'PerfilController@index')->name('perfil');
    Route::patch('/perfil/{id}','PerfilController@update')->name('update.user');
    Route::get('/estadoContratoT-{id}', [ContractController::class,'contractStateTalent'])->name('estadoContratoTal');
    Route::get('/estadoContratoO-{id}', [ContractController::class,'contractStateOcupation'])->name('estadoContratoOcu');
    
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
})->name('registrouser');
Route::post('/registrar','HomeController@nuevoRegistro');



Route::get('registroServicio',[ServiceController::class, 'registro'])->name('offerMyService');

Route::get('/perfilservicio',function(){
    return view('perfilservicio');
});


Route::get('/servicio',function(){
    return view('servicio');
});


Route::get('/talento',function(){
    return view('talento');
});



