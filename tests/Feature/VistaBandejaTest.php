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
use App\Http\Controllers\ContractController;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VistaBandejaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */

    const email = "vizcarra@gmail.com";
    const password = "vacassss" ;

    //No muestra la pagina de mensajes si no está logeado
    public function test_vista_bandeja()
    {
        $this->get('/bandeja')
        ->assertSee('/login');
    }

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

    //Return de componente
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

    //Chat usuario
    public function test_estado_chat_ocupacion(){

        //Vemos que exista el contrato de prueba
        // $this->assertTrue(Contract::whereCon_status("1")->exists());

        Contract::create([
            'con_contract_date'=>'2021-07-26',
            'con_hour'=>'15:10:12',
            'con_address'=>'Contrato nuevo para vizcarra',
            'con_description'=>'Vizcarra necesita un contrato',
            'con_price'=>'232.23',
            'con_initial'=>'2021-08-08 23:33:31.000000',
            'use_offer'=>'1',
            'use_receive'=>2,
            'use_occ_id'=>1,
            'con_status'=>1,
        ]);

        $this->get('/login')->assertSee('/login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];

        $response = $this->post('/login', $credentials);

        // $contractCreate =  new ContractController();
        // $requestContract =  $this->contractRequest(1,20.00);
        // $response = $contractCreate->contractCreate($requestContract);
        //Logeamos al usuario
        //Comprobamos que puede ver el chat de su servicio contratado
        $this->get('/profileServiceOccupation/1')
        ->assertSeeLivewire('chat-usuario');
    }

    // Chat talents
    public function test_estado_chat_talento(){
        //Vemos que exista el contrato de prueba
        // $this->assertTrue(Contract::whereCon_status("1")->exists());
        
        Contract::create([
            'con_contract_date'=>'2021-07-26',
            'con_hour'=>'15:10:12',
            'con_address'=>'Contrato nuevo para vizcarra',
            'con_description'=>'Vizcarra necesita un contrato',
            'con_price'=>'232.23',
            'con_initial'=>'2021-08-08 23:33:31.000000',
            'use_offer'=>3,
            'use_receive'=>2,
            'use_tal_id'=>2,
            'con_status'=>1,
        ]);

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

    public function test_servicio(){

        Livewire::test(Filtroservicio::class)
            ->call('talentoM',2);
            
        Livewire::test(Filtroservicio::class)
            ->call('ocupacionM',2);
    }

    public function test_responder_mensajee(){

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
            ->set('respuesta', 'hola')
            ->set('para',2)
            ->set('vendedor',3)
            ->set('id_servicio',2)
            ->call('enviarRespuesta');
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
}
