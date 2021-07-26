<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Models\Contract;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ContractController;

class ejectContractTest extends TestCase
{
    /**
     * 
     *
     * @test
     */
    public function ejectContractTest()
    {
        $contrat = Contract::findOrFail(2);;
        $ContrContract =  new ContractController();
        $credentials = [
            "email" => "pato@gmail.com",
            "password" => "password",
        ];
        Storage::fake('avatars');
        $this->post('login', $credentials);
        $requestServices = new Request([
            'contractId' => $contrat->id,
        ]);
        $responses = $ContrContract->ejectContract($requestServices);
        $this->assertContains('El contrato entró en ejecución',
        [$responses->getSession()->get('serviceMessage')]);
    }
}
