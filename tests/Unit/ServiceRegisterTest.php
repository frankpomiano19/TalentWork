<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiceController;

class ServiceRegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     */
    function test_view_ServiceRegister_page()
    {
        
        
        $serviciosTec = ServiceOccupation::all();
        $serviciosTal = ServiceTalent::all();
        $this->get('registroServicio')
            ->assertStatus(200);
        $view = $this->view('registroServicio',compact('serviciosTec','serviciosTal'));
        //Comprobación de que exite un servicio tecnico
        $view->assertSee('Reparador de computadoras');
        //Comprobación de que exite un servicio de talento
        $view->assertSee('Abridor de cajas');
        



    }

    function test_post_ServiceRegister_Ocupation(){
        $response = $this->post(route('login'), [
            'email' => 'XSsNjAdV5a@gmail.com',
            'password' => 'password'
        ]);

        $response = $this->post(route('servicio.tecnico'), [
            'servicioTecn' => 'Gasfitero de madrigueras',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect('/');
    }

    function test_post_ServiceRegister_Ocupation_without_login(){

        $response = $this->post(route('servicio.tecnico'), [
            'servicioTecn' => 'Gasfitero de madrigueras',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect('/login');
    }

    function test_post_ServiceRegister_Talent(){
        $response = $this->post(route('login'), [
            'email' => 'XSsNjAdV5a@gmail.com',
            'password' => 'password'
        ]);

        $response = $this->post(route('servicio.talento'), [
            'servicioTecn' => 'Narrador de Audiolibros',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect('/');
    }

    function test_post_ServiceRegister_Talent_without_login(){

        $response = $this->post(route('servicio.talento'), [
            'servicioTecn' => 'Narrador de Audiolibros',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect('/login');
    }

    public function contractHttp(){
        $requestReception = new Request([
            'servicioTecn' => '2',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' =>  new UploadedFile('C:\ProyectoLaravel\TalentWork\public\uploads\a.png','image_prueba'), //UploadedFile::fake()->image('avatar.jpg'),
        ]);        
        return $requestReception;
    }
    /*
    public function test_post_ServiceRegister_Ocupation_complete(){
        $servicioTec = use_occ::first();

        $registroTecnico =  new ServiceController();
        $credentials = [
            "email" => "XSsNjAdV5a@gmail.com",
            "password" => "password",
        ];
        Storage::fake('avatars');
        $this->post('login', $credentials);
        $requestService = new Request([
            'servicioTecn' => $servicioTec->ser_occ_id,
            'detallesTecn' => $servicioTec->precio,
            'costoTecn' => 500.00,
            'imagenTecn' => //new UploadedFile('C:\Users\Personal\Pictures\ligero descuento.jpg','a'), 
            UploadedFile::fake()->image('avatar.jpg', 500,600)->size(1000),
        ]);
        //$requestService = $this->contractHttp();
        
        $response = $registroTecnico->registroTecnico($requestService);
        //dd($response);
        //$this->assertContains('Servicio de ocupación registrado exitosamente',[$response->getSession()->get('serviceMessage')]);
    }*/

}
