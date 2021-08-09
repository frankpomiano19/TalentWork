<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Auth;

class ContractRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    const email = "pato@gmail.com";
    const password = "password" ;
    
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
        $this->sessionAutenticacion(self::email,self::password);
        // $user = Auth::loginUsingId(1);
        $response = $this->actingAs(auth()->user())->post(route('iPContract'));


        $response->assertRedirect('/');
    }

    /** @test */    
    public function redirectionProcessContractSuccessCaseOne(){
        // Crea una contrato con oficios
        // Para ContractController
        // Ataca el metodo contractCreate, el caso 1
        $contractCreate =  new ContractController();
        $this->sessionAutenticacion(self::email,self::password);

        $requestContract =  $this->contractRequest(1,20.00);
        $response = $contractCreate->contractCreate($requestContract);
        $this->assertContains('Contratado el oficio correctamente',[$response]);

        // $this->assertContains('Contratado el oficio correctamente',[$response->getSession()->get('contractMessage')]);
        // $this->assertContains(302,[$response->getStatusCode()]);
    }

    /** @test */        
    public function redirectionProcessContractSuccessCaseTwo(){
        // Crea una contrato con talentos
        // Para ContractController
        // Ataca el metodo contractCreate, el caso 2
        // $responde = (new LoginController())->showLoginForm();
        // dd($responde->view());
        $contractCreate =  new ContractController();
        $this->sessionAutenticacion(self::email,self::password);
        $requestContract =  $this->contractRequest(2,20.00);
        $response = $contractCreate->contractCreate($requestContract);
        $this->assertContains('Contratado el talento correctamente',[$response]);
        // $this->assertContains('Contratado el talento correctamente',[$response->getSession()->get('contractMessage')]);
        // $this->assertContains(302,[$response->getStatusCode()]);



    }

    /** @test */        
    public function redirectionProcessContractSuccessCaseThree(){
        // Crea una contrato con talentos
        // Para ContractController
        // Ataca el metodo contractCreate, el caso 3

        $contractCreate =  new ContractController();
        $this->sessionAutenticacion(self::email,self::password);


        $requestContract =  $this->contractRequest(10,20.00);
        $response = $contractCreate->contractCreate($requestContract);
        $this->assertContains('Error no se pudo crear el contrato',[$response]);
        // $this->assertContains('Error no se pudo crear el contrato',[$response->getSession()->get('contractMessage')]);
        // $this->assertContains(302,[$response->getStatusCode()]);        
    
    }
    /** @test */        
    public function validationCreateContract(){
        $contractCreate =  new ContractController();
        $this->sessionAutenticacion(self::email,self::password);

        $requestContract =  $this->contractHttp(null);
        $response = $this->post(route('iPContract'),$requestContract)->assertSessionDoesntHaveErrors(['priceOffer']);
        // $response->assertSessionHasErrors(['priceOffer']);
        // $response = $contractCreate->contractProcess($requestContract);   
        // dd($response->getSession()->error_reporting);
    }

    /** @test */        
    public function verifyRoutePaymentView(){
        $response= $this->get(route('index.checkout'));
        $response->assertStatus(302);
    }


    /** @test */        
    public function getOneItemFromCartToTest(){
        $controllerContract = new ContractController();
        $this->sessionAutenticacion(self::email,self::password);
        $controllerContract->clearAllCart();
        $requestContract = $this->contractRequest(1,20.00);
        // Crea un elemento en el carrito
        $redirect = $controllerContract->validationFieldDescriptionContract($requestContract);
        $this->assertContains(302,[$redirect->getStatusCode()]);
        // Obtiene un elemento
        $elementCart = $controllerContract->getOneItemFromCart();
        $this->assertContains(2,[$elementCart->id]);
        

    }



    /** @test */        
    public function paymentProccessContract(){

        $paymentInCreate =  new ContractController();
        $this->sessionAutenticacion(self::email,self::password);
        $requestContract = $this->contractRequest(1,20.00);
        $response = $paymentInCreate->validationFieldDescriptionContract($requestContract);
        $this->assertContains(302,[$response->getStatusCode()]);

        $response = $paymentInCreate->processPaymentServiceContract();
        $this->assertContains(302,[$response->getStatusCode()]);
    }

    /** @test */        
    public function clearOneElementoFromCart(){
        $instanceOfContract =  new ContractController();
        $this->sessionAutenticacion(self::email,self::password);        
        $requestContract = $this->contractRequest(1,20.00);
        $instanceOfContract->validationFieldDescriptionContract($requestContract);
        $response = $instanceOfContract->clearCart(2);
        $this->assertContains(302,[$response->getStatusCode()]);
    }

    public function contractRequest($typeOfJobNow,$price){
        if($typeOfJobNow==1){
            $requestReception = new Request([
                'dateForm'=>'2021-06-07 00:00:00',
                'hourForm'=>'12:47:00.0000',
                'addressForm'=>'Avenida siempre viva 123',
                'descriptionForm'=>'En 5 horas llegas a casa',
                'priceOffer'=>$price,
                'userOffer'=>2, 
                'serviceOffer'=>2,
                'typeOfJob'=>$typeOfJobNow,
                'serviceName'=>'Reparador de computadoras',
                'img1'=>'https://www.compudepot.net/data/files/instalacion-mantenimiento-y-reparacion-de-pc-y-redes_30871784_xxl.jpg',
                'statusInitial'=>1,
                'userNameProvider'=>'Vizcarra Presidente'

    
            ]);        
    
        }else{
            $requestReception = new Request([
                'dateForm'=>'2021-06-07 00:00:00',
                'hourForm'=>'12:47:00.0000',
                'addressForm'=>'Avenida siempre viva 123',
                'descriptionForm'=>'En 5 horas llegas a casa',
                'priceOffer'=>$price,
                'userOffer'=>2, 
                'serviceOffer'=>2,
                'typeOfJob'=>$typeOfJobNow,
                'serviceName'=>'Bailarin',
                'img1'=>'https://www.compudepot.net/data/files/instalacion-mantenimiento-y-reparacion-de-pc-y-redes_30871784_xxl.jpg',
                'statusInitial'=>1,
                'userNameProvider'=>'Vizcarra Presidente'
    
            ]);        

        }
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

    public function sessionAutenticacion($email, $password){
        $credentials = [
            "email" => $email,
            "password" => $password,
        ];
        $this->post('login', $credentials);
    }
}
