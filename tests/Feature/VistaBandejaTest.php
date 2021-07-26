<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Contract;
use App\Models\use_occ;
use Livewire\Livewire;
use App\Http\Livewire\ChatUsuario;
use App\Http\Livewire\Filtroservicio;
use App\Http\Livewire\ChatLista;
use App\Models\Mensajechat;
use Tests\TestCase;

class VistaBandejaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //No muestra la pagina de mensajes si no está logeado
    public function test_vista_bandeja()
    {
        $this->get('/bandeja')
        ->assertSee('/login');
    }

    //Mostrar la vista de mensajes
    public function test_lista_mensajes(){

        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];

        $response = $this->post('/login', $credentials);
        $response->assertSee('/occupationService');
        $this->assertCredentials($credentials);

        $this->get('/bandeja')
        ->assertSee('/bandeja')
        ->assertStatus(200);
        
    }

    //Muestra el componente de bandeja de entrada
    public function test_vista_componente(){
        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];

        $response = $this->post('/login', $credentials);

        $this->get('/bandeja')
        ->assertSeeLivewire('chat-lista');
    }

    public function test_estado_chat(){
        //Vemos que exista el contrato de prueba
        $this->assertTrue(Contract::whereCon_status("1")->exists());
        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];
        //Logeamos al usuario
        $response = $this->post('/login', $credentials);

        //Comprobamos que puede ver el chat de su servicio contratado
        $this->get('/profileServiceTalent/2')
        ->assertSeeLivewire('chat-talents');
    }

    public function test_chat_componente(){

        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];
        //Logeamos al usuario
        $response = $this->post('/login', $credentials);
        
        //Comprobamos que se muestre la lista de mensajes como ofertante
        Livewire::test(ChatLista::class);
    }

    public function test_estado_chatdos(){
        //Vemos que exista el contrato de prueba
        $this->assertTrue(Contract::whereCon_status("1")->exists());
        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];
        //Logeamos al usuario
        $this->post('/login', $credentials);

        //Comprobamos que puede ver el chat de su servicio contratado
        $this->get('/profileServiceOccupation/2')
        ->assertSeeLivewire('chat-usuario');
    }

    public function test_servicio(){

        Livewire::test(Filtroservicio::class)
            ->call('talentoM',2);
            
        Livewire::test(Filtroservicio::class)
            ->call('ocupacionM',2);
            
    }
    
    public function test_responder_mensaje(){

        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "merino@gmail.com",
            "password" => "valorant"
        ];
        
        //Logeamos al usuario
        $this->post('/login', $credentials);

        $this->get('/bandeja')
        ->assertSeeLivewire('chat-lista');

        Livewire::test(ChatLista::class)
            ->call('responderM',2,2);

        Livewire::test(ChatLista::class)
            ->call('actualizaMensaje',2,2);

        
    }

    // public function test_valida_mensaje(){

    //     $this->assertTrue(Mensajechat::wherecliente('2')->exists());

    //     $this->get('/login')->assertSee('/login');
    //     $credentials = [
    //         "email" => "vizcarra@gmail.com",
    //         "password" => "vacassss"
    //     ];
        
    //     //Logeamos al usuario
    //     $this->post('/login', $credentials);

    //     $user = auth()->user();

    //     Livewire::actingAs($user);

    //     $this->get('/profileServiceOccupation/1')
    //     ->assertSeeLivewire('chat-usuario');

    //     $datos = Mensajechat::where('cliente','=',2)->firts();

    //     $mensaje = 'abcdefgh';

    //     Livewire::test(ChatUsuario::class)
    //         ->set('mensaje',$datos->mensaje)
    //         ->set('respuesta','zxcvbc')
    //         ->set('id_servici',1)
    //         ->set('vendedo',$datos->envia)
    //         ->set('variable',2)
    //         ->call('enviarMensaje')
    //         ->assertEmitted('enviado');
    // }
}
