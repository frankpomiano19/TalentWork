<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'showOccupationService'])->name('ServiciosOfrecidos');
Route::get('/talentService',[HomeController::class,'showTalentService'])->name('showTalentService');
Route::get('/occupationService',[HomeController::class,'showOccupationService'])->name('showOccupationService');
Route::get('/profileServiceTalent/{id}',[HomeController::class,'showProfileServiceTalent'])->name('showProfileServiceTalent');
Route::get('/profileServiceOccupation/{id}',[HomeController::class,'showProfileServiceOccupation'])->name('showProfileServiceOccupation');

Route::middleware(['auth'])->group(function () {
    // Carrito
    Route::post('/checkout/serviceProccess',[ContractController::class,'validationFieldDescriptionContract'])->name('contractDetailsData');
    Route::delete('/cart/destroy/{idUser}',[ContractController::class,'clearCart'])->name('cart.destroy');
    Route::get('/checkout/service',[ContractController::class,'checkoutPaymentView'])->name('index.checkout');

    // Pago con paypal
    Route::post('/paypal/payService', [ContractController::class,'processPaymentServiceContract'])->name('continuePaymentPaypal');
    Route::get('/paypal/status', [ContractController::class,'payPalStatus']);
    Route::get('/paypal/cancel',[ContractController::class,'cancelPaypal'])->name('cancelValue');

    Route::post('/proccessContract',[ContractController::class,'contractProcess'])->name('iPContract');
    Route::post('/registroServTecnico',[ServiceController::class,'registroTecnico'])->name('servicio.tecnico');
    Route::post('/registroServTalento',[ServiceController::class,'registroTalento'])->name('servicio.talento');
    Route::get('/perfil/{id}', 'PerfilController@index')->name('perfil');
    Route::patch('/perfil/{id}','PerfilController@update')->name('update.user');
    
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('nuevo',function(){
    return view('nuevo');
});

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
Route::get('/talento',function(){
    return view('talento');
});
Route::get('/pagoPrueba',function(){
    return view('pagoPrueba');
});