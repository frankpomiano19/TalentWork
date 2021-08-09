<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use App\Models\Contract;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ContractController;

class StateContractTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     */
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

    
}
