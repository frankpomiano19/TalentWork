<?php

namespace Tests\Feature;

use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaymentPremiumController;
use App\Models\use_occ;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */  
    public function processPaymentStripeTest()
    {
        Auth::loginUsingId(2);
        $data = [
            'serviceOffer'=>2,
            'cantidadMeta'=>500,
            'cantidadActual'=>10,
            'cantidadDonacion'=>100

        ];
        $this->post(route('proccessPaymentStripe2',$data))->assertStatus(302);
    }

    /** @test */  
    public function paymentStripeSuccessChange(){
        Auth::loginUsingId(2);
        $data = [
            'serviceOffer'=>2,
            'cantidadMeta'=>600,
            'cantidadActual'=>10,
            'cantidadDonacion'=>590,
            'typeOfJob'=>1

        ];
        $this->post(route('proccessPaymentStripe2',$data))->assertStatus(302);
        $this->assertDatabaseHas('changes',[
            'ser_occ_change'=>2,
            'cha_active'=>false
        ]);
    }


    /** @test */  
    public function paymentStripeSuccessContractOccupation(){
        Auth::loginUsingId(3);
        $instanceOfContract =  new ContractController();
        $requestContract = $this->contractRequest(1,20.00);
        $instanceOfContract->validationFieldDescriptionContract($requestContract);
        $data = [
            'serviceOffer'=>1,

        ];
        $valor =  $this->post(route('proccessPaymentStripe',$data));
        $valor->assertRedirect(route('showProfileServiceOccupation',1));
    }    


    /** @test */  
    public function paymentStripeSuccessContractTalent(){
        Auth::loginUsingId(3);
        $instanceOfContract =  new ContractController();
        $requestContract = $this->contractRequest(2,20.00);
        $instanceOfContract->validationFieldDescriptionContract($requestContract);
        $data = [
            'serviceOffer'=>1,
        ];
        $valor =  $this->post(route('proccessPaymentStripe',$data));
        $valor->assertRedirect(route('showProfileServiceTalent',1));
    }    


    /** @test */  
    public function paymentPaypalSuccessContractTalentStatus(){
        Auth::loginUsingId(3);
        $instanceOfContract =  new ContractController();
        $requestContract = $this->contractRequest(2,20.00);
        $instanceOfContract->validationFieldDescriptionContract($requestContract);
        $data = [
            "paymentId" => "PAYID-MENLAMI6HJ22492R5448821X",
            "token" => "EC-046476996D356251X",
            "PayerID" => "DBTZGPWRJ6XFS"

        ];
        $view = $this->get(route('paypal.status.now',$data));
        $view->assertRedirect(route('showProfileServiceTalent',1));
    }    


    /** @test */  
    public function paymentPaypalSuccessContractOccupationStatus(){
        Auth::loginUsingId(3);
        $instanceOfContract =  new ContractController();
        $requestContract = $this->contractRequest(1,20.00);
        $instanceOfContract->validationFieldDescriptionContract($requestContract);
        $data = [
            "paymentId" => "PAYID-MENLAMI6HJ22492R5448821X",
            "token" => "EC-046476996D356251X",
            "PayerID" => "DBTZGPWRJ6XFS"

        ];
        $view = $this->get(route('paypal.status.now',$data));
        $view->assertRedirect(route('showProfileServiceOccupation',1));
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
                'serviceOffer'=>1,
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
                'serviceOffer'=>1,
                'typeOfJob'=>$typeOfJobNow,
                'serviceName'=>'Bailarin',
                'img1'=>'https://www.compudepot.net/data/files/instalacion-mantenimiento-y-reparacion-de-pc-y-redes_30871784_xxl.jpg',
                'statusInitial'=>1,
                'userNameProvider'=>'Vizcarra Presidente'
    
            ]);        

        }
        return $requestReception; 
    }    
}
