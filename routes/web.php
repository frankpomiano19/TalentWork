<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;

use App\Events\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
// define('ROUTEPERFILNOW', '/perfil/{id}');

Route::get('/perfil/{id}', 'PerfilController@index')->name('perfil');

Route::get('/',[HomeController::class,'showOccupationService'])->name('ServiciosOfrecidos');
Route::get('/talentService',[HomeController::class,'showTalentService'])->name('showTalentService');
Route::get('/occupationService',[HomeController::class,'showOccupationService'])->name('showOccupationService');
Route::get('/profileServiceTalent/{id}',[HomeController::class,'showProfileServiceTalent'])->name('showProfileServiceTalent');
Route::get('/profileServiceOccupation/{id}',[HomeController::class,'showProfileServiceOccupation'])->name('showProfileServiceOccupation');
Route::post('/comment','PostCommentController@newComment')->name('registrarComent');
Route::post('/question','PostCommentController@newQuestion')->name('registrarPreg');
Route::post('/answer','PostCommentController@newAnswer')->name('registrarComentR');

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
    Route::get('/estadoContratoT-{id}', [ContractController::class,'contractStateTalent'])->name('estadoContratoTal');
    Route::get('/estadoContratoO-{id}', [ContractController::class,'contractStateOcupation'])->name('estadoContratoOcu');
    Route::post('/finalizarContr',[ContractController::class,'finishContract'])->name('end.contract');
    Route::post('/ejecutarContr',[ContractController::class,'ejectContract'])->name('eject.contract');
    
});


Auth::routes();

Route::get('nuevo',function(){
    return view('nuevo');
});

Route::get('bandeja',function(){
    return view('bandejamensajes');
})->middleware('auth')->name('bandeja');


Route::get('template',function(){
    return view('template');
});

Route::get('login',function(){
    return view('login');
})->name('login');


Route::get('registro',function(){
    return view('registro');
})->name('registrouser');
Route::get('servicio',function(){
    return view('servicio');
});
Route::get('informa',function(){
    return view('nada');
});
Route::get('serviciopremium',function(){
    return view('serviciopremium');
});


Route::post('/registrar',[HomeController::class,'nuevoRegistro'])->name('registrarUsuario');

Route::get('registroServicio',[ServiceController::class, 'registro']);



Route::get('/categorias',function(){
    return view('categoria/filtroServicio');
})->name('categorias');

Route::get('/servicio',function(){
    return view('servicio');
});
Route::get('perfil',function(){
    return view('perfil');
});
Route::get('registroServicio',[ServiceController::class, 'registro']);

Route::get('/servicio',function(){
    return view('servicio');
});
Route::get('perfil',function(){
    return view('perfil');
});
Route::get('registroServicio',[ServiceController::class, 'registro']);


Route::get('registroServicio',[ServiceController::class, 'registro'])->name('offerMyService');

Route::get('/talento',function(){
    return view('talento');
});

Route::get('/estadoContrato',function(){
    return view('estadoContrato');
});

Route::get('/pagoPrueba',function(){
    return view('pagoPrueba');
});


Route::get('/chatNuevo',function(){
    return view('chatNuevo');
});

Route::post('/send-message',function(Request $request){
    event(
        new Message(
            $request->input('username'),
            $request->input('message')));
    
    return ["success"=>true];
});

Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

Broadcast::channel('chat', function () {
    return Auth::check();
});
