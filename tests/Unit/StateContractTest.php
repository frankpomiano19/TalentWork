<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use App\Models\Contract;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ContractController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StateContractTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     */
    use DatabaseTransactions;

    /** @test */  
    public function FinishContratTest()
    {
        $contrat = Contract::first();
        $ContrContract =  new ContractController();
        $credentials = [
            "email" => "pato@gmail.com",
            "password" => "password",
        ];
        Storage::fake('avatars');
        $this->post('login', $credentials);
        $requestService = new Request([
            'contractId' => $contrat->id,
        ]);
        $response = $ContrContract->finishContract($requestService);
        $this->assertContains('Su contrato ha sido finalizado',
        [$response->getSession()->get('serviceMessage')]);
    }

    /** @test */  
    public function FinishContratTestRequiredContract()
    {
        $contrat = Contract::first();
        $ContrContract =  new ContractController();
        $credentials = [
            "email" => "pato@gmail.com",
            "password" => "password",
        ];
        Storage::fake('avatars');
        $this->post('login', $credentials);
        $requestService = new Request([
        ]);

        try{
            $ContrContract->finishContract($requestService);
        }catch(ValidationException $e){
            $error = $e->errors();
            $this->assertArrayHasKey('contractId',$error);
        }   
    }

        /** @test */  
        public function FinishContratTestNotNumericContract()
        {
            $contrat = Contract::first();
            $ContrContract =  new ContractController();
            $credentials = [
                "email" => "pato@gmail.com",
                "password" => "password",
            ];
            Storage::fake('avatars');
            $this->post('login', $credentials);
            $requestService = new Request([
                'contractId' => "adawdawdawd",
            ]);
    
            try{
                $ContrContract->finishContract($requestService);
            }catch(ValidationException $e){
                $error = $e->errors();
                $this->assertArrayHasKey('contractId',$error);
            }   
        }

    /** @test */  
    public function contractStateTalentTest(){
        Auth::loginUsingId(7);
        $view = $this->get(route('estadoContratoTal',2))->assertStatus(200);
        $view->assertSee('Soy un buen narrador, cuento buenos chistes');
    }

    /** @test */  
    public function contractStateOccTest(){
        Auth::loginUsingId(7);
        $view = $this->get(route('estadoContratoOcu',1))->assertStatus(200);
        $view->assertSee('Hago cualquier tipo de diseño grafico 2D o 3D');
    }

}
