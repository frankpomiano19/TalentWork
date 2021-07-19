<?php

namespace Tests\Feature;

use App\Http\Controllers\Auth\LoginController;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PerfilController;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Auth;

class ContractRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */



     /** @test */
    public function routeProcessContractPost(){
        // Peticion post aceptada
        $response = $this->post(route('iPContract'));
        $response->assertStatus(302);        
    }


    /** @test */
    public function routeProcessContractGet(){
        // No soporta Get
        $response = $this->get(route('iPContract'));
        $response->assertStatus(405);        
    }

    /** @test */
    public function routeProcessContractAutentication(){
        // Peticion post con autenticacion

        $user = Auth::loginUsingId(1);
        $response = $this->actingAs($user)->post(route('iPContract'));


        $response->assertRedirect('/');
    }

    /** @test */    
    public function redirectionProcessContractSuccessCaseOne(){

        // Crea una contrato con oficios
        // Para ContractController
        // Ataca el metodo contractCreate, el caso 1
        $contractCreate =  new ContractController();
        $credentials = [
            "email" => "mandarin@gmail.com",
            "password" => "mandarin",
        ];
        $this->post('login', $credentials);


        $requestContract =  $this->contractRequest(1,20.00);
        $response = $contractCreate->contractProcess($requestContract);
        $this->assertContains('Contratado el oficio correctamente',[$response->getSession()->get('contractMessage')]);
        $this->assertContains(302,[$response->getStatusCode()]);
    }

    /** @test */        
    public function redirectionProcessContractSuccessCaseTwo(){
        // Crea una contrato con talentos
        // Para ContractController
        // Ataca el metodo contractCreate, el caso 2

        // $responde = (new LoginController())->showLoginForm();
        

        // dd($responde->view());

        $contractCreate =  new ContractController();
        $credentials = [
            "email" => "mandarin@gmail.com",
            "password" => "mandarin",
        ];
        $this->post('login', $credentials);


        $requestContract =  $this->contractRequest(2,20.00);
        $response = $contractCreate->contractProcess($requestContract);
        $this->assertContains('Contratado el talento correctamente',[$response->getSession()->get('contractMessage')]);
        $this->assertContains(302,[$response->getStatusCode()]);



    }

    /** @test */        
    public function redirectionProcessContractSuccessCaseThree(){
        // Crea una contrato con talentos
        // Para ContractController
        // Ataca el metodo contractCreate, el caso 3

        $contractCreate =  new ContractController();
        $credentials = [
            "email" => "mandarin@gmail.com",
            "password" => "mandarin",
        ];
        $this->post('login', $credentials);


        $requestContract =  $this->contractRequest(10,20.00);
        $response = $contractCreate->contractProcess($requestContract);
        $this->assertContains('Error no se pudo crear el contrato',[$response->getSession()->get('contractMessage')]);
        $this->assertContains(302,[$response->getStatusCode()]);        
    
    }
    /** @test */        
    public function validationCreateContract(){
        $contractCreate =  new ContractController();
        $credentials = [
            "email" => "mandarin@gmail.com",
            "password" => "mandarin",
        ];
        $this->post('login', $credentials);

        $requestContract =  $this->contractHttp(null);
        $response = $this->post(route('iPContract'),$requestContract)->assertSessionDoesntHaveErrors(['priceOffer']);
        // $response->assertSessionHasErrors(['priceOffer']);
        // $response = $contractCreate->contractProcess($requestContract);   
        // dd($response->getSession()->error_reporting);
    }

    public function contractRequest($typeOfJobNow,$price){
        $requestReception = new Request([
            'dateForm'=>'2021-06-07 00:00:00',
            'hourForm'=>'12:47:00.0000',
            'addressForm'=>'Avenida siempre viva 123',
            'descriptionForm'=>'En 5 horas llegas a casa',
            'priceOffer'=>$price,
            'userOffer'=>2,
            'serviceOffer'=>2,
            'typeOfJob'=>$typeOfJobNow
        ]);        
        return $requestReception; 
    }

    public function contractHttp($price){
        $requestReception = [
            'dateForm'=>'2021-06-07 00:00:00',
            'hourForm'=>'12:47:00.0000',
            'addressForm'=>'Avenida siempre viva 123',
            'descriptionForm'=>'En 5 horas llegas a casa',
            'priceOffer'=>$price,
            'userOffer'=>2,
            'serviceOffer'=>2,
            'typeOfJob'=>1
        ];        
        return $requestReception;         
    }
}
