<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tablon;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;

class TablonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function test_vista_tablon()
    {    
        $credentials = [
            "email" => "pato@gmail.com",
            "password" => "password",
        ];

        $ocupaciones = ServiceOccupation::all();
        $talentos = ServiceTalent::all();
        $servicios = Tablon::all();

        $response = $this->post('login', $credentials);

        $this->get('tablonServicios')
            ->assertStatus(200);
        
        $view = $this-> view('tablonservicios',compact('talentos','ocupaciones','servicios'));
    }

    public function test_no_vista_tablon(){

        $this->get('tablonServicios')
            ->assertRedirect('/login');
    }
    
    public function test_solicitar_servicio(){

        $response = $this->post(route('login'), [
            'email' => 'pato@gmail.com',
            'password' => 'password'
        ]);

        $datosSolicitar = $this->post(route('tablon.servicio'), [
            'nombre' => 'Limpiador de casas',
            'descripcion' => 'Necesito un limpiador de casas por favor',
            'precio' => '23.98',
            'tipo' => 'Talento',
        ])->assertRedirect('/');
    }

    public function test_solicitar_datos_invalidos(){

        $response = $this->post(route('login'), [
            'email' => 'pato@gmail.com',
            'password' => 'password'
        ]);

        $response = $this->post(route('tablon.servicio'), []);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['nombre','descripcion','tipo','precio']);
    }
}
