<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use App\Models\use_occ;
use App\Models\use_tal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */          
    public function getViewAllServiceOccupationRoot()
    {   
        $servicio = use_tal::orderBy('created_at','DESC')->paginate(20);
        // Comprobamos que la vista sea retornada
        $response = $this->get(route('ServiciosOfrecidos'))->assertViewIs('profileServiceOccupation');
        // Comprobamos que los datos se desplieguen
        $response->assertSee($servicio);
        $response->assertStatus(200);
    }

    /** @test */          
    public function getViewAllServiceTalent(){

        $servicio = use_tal::orderBy('created_at','DESC')->paginate(20);
        // Comprobamos que la vista sea retornada
        $response = $this->get(route('showTalentService'))->assertViewIs('profileServiceTalent');
        // Comprobamos que los datos se desplieguen
        $response->assertSee($servicio);
        $response->assertStatus(200);
    }


    /** @test */          
    public function getViewAllServiceOccupation(){
        
        $servicio = use_occ::orderBy('created_at','DESC')->paginate(20);
        // Comprobamos que la vista sea retornada
        $response = $this->get(route('showOccupationService'))->assertViewIs('profileServiceOccupation');
        // Comprobamos que los datos se desplieguen
        $response->assertSee($servicio);
        $response->assertStatus(200);
    }    


    /** @test */          
    public function getViewAllServiceProfileOccupation(){
        $idService = 1;
        $serviceProfile = use_occ::where('id',$idService)->first();
        // Comprobamos que la vista sea retornada
        $response = $this->get('/profileServiceOccupation/'.$idService);
        $response->assertViewIs('servicioOccupation');
        $response->assertStatus(200);
        // $response->assertSee($serviceProfile);
        // Comprobamos que los datos se desplieguen
        // $response->assertSee($serviceProfile);
    }      


    public function getViewAllServiceProfileTalent(){
        $idService = 1;
        $serviceProfile = use_tal::where('id',$idService)->first();
        // Comprobamos que la vista sea retornada
        $response = $this->get('/profileServiceTalent/'.$idService);
        $response->assertViewIs('servicioTalent');
        $response->assertStatus(200);
        // $response->assertSee($serviceProfile);
        // Comprobamos que los datos se desplieguen
        // $response->assertSee($serviceProfile);
    }      

}
 