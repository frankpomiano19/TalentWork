<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EraserController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;

use App\Events\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::get('login',function(){
    return view('login');
})->name('login');


Route::get('registro',function(){
    return view('registro');
})->name('registrouser');

/*Route::get('perfil',function(){
    return view('perfil');
});*/
Route::get('servicio',function(){
    return view('servicio');
});
Route::get('serviciopremium',function(){
    return view('serviciopremium');
});

Route::get('/perfil/{id}', 'PerfilController@index')->name('perfil');
Route::patch('/perfil/{id}','PerfilController@update')->name('update.user');
//Route::post('/actualizar','PerfilController@update');
Route::post('/registrar','HomeController@nuevoRegistro');
Route::get('registroServicio',[ServiceController::class, 'registro']);
Route::get('/welcome1',function(){
return view( 'reg-serv-indep');
})->name('registerServiceAllNow');

Route::get('/perfilservicio',function(){
    return view('perfilservicio');
});

Route::get('/servicio',function(){
    return view('servicio');
});
//Route::get('registro',function(){
//    return view('registro');
//});
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
Route::get('/talento',function(){
    return view('talento');
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

Broadcast::channel('chat', function ($user) {
    return Auth::check();
});