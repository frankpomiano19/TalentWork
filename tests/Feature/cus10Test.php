<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contract;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\ServiceTalent;
use App\Models\ServiceOccupation;
use App\Http\Controllers\ContractController;

class cus10Test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_contractStateTalent(){
        $idContract = 1;
        $contr = Contract::findOrFail($idContract);
        $userOff = User::findOrFail($contr->use_offer);
        $dataTal = use_tal::findOrFail($contr->use_tal_id);
        $servTalen = ServiceTalent::findOrFail($contr->use_tal_id);
        $response = $this->get('/estadoContratoO/'.$idContract);
        $response->assertStatus(200);
        $view = $this-> view('estadoContratoTal',compact('idContract','contr','servTalen','userOff','dataTal'));

    }

    public function test_contractStateOcupation(){
        $idContract = 1;
        $contr = Contract::findOrFail($idContract);
        $userOff = User::findOrFail($contr->use_offer);
        $dataOcup = use_occ::findOrFail($contr->use_occ_id);
        $servOcupp = ServiceOccupation::findOrFail($contr->use_occ_id);
        $response = $this->get('/estadoContratoT/'.$idContract);
        $response->assertStatus(200);
        $view = $this-> view('estadoContratoOcu',compact('idContract','contr','servOcupp','userOff','dataOcup'));
       
    } 
}
