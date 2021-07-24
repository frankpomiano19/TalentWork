<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
use Illuminate\Http\Request;
use Illuminate\Http\Controllers\PerfilController;
use Illuminate\Http\Controllers\ServiceController;

class PostAnswerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_profileSO_view()
    {
        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        //$view = $this->view('perfil', compaq(auth()->user()->id));

        $view->assertSee('Estan chidos tus momos, eres un crack');
    }

    public function test_profileST_view()
    {
        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        //$view = $this->view('perfil', compaq(auth()->user()->id));

        $view->assertSee('Tus historias son geniales, vale la pena cada centavo');
    }

    public function test_errorValidation_postAnswerFailed_OCC()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'ComFail';
        // $use_com_id = '4';
        $ComId = '5';
        // $etiqueta1 = '';
        // $etiqueta2 = '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarComentR'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'ComId'=>$ComId 
                                                                ]
                                )->assertRedirect('/profileServiceOccupation/2');

        $response = $this->assertDatabaseMissing('answers', [
                                    'comentario'=>$comentario,
                                ]);
                                //->assertRedirect('/profileServiceOccupation/3')
        
    }

    public function test_errorValidation_postAnswerFailed_TAL()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'ComFail';
        // $use_com_id = '4';
        $ComId = '6';
        // $etiqueta1 = '';
        // $etiqueta2 = '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarComentR'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'ComId'=>$ComId
                                                                ]
                                )->assertRedirect('/profileServiceTalent/1');

        $response = $this->assertDatabaseMissing('answers', [
                                    'comentario'=>$comentario,
                                ]);
                                //->assertRedirect('/profileServiceOccupation/3')
        
    }

    public function test_errorValidation_postAnswer_OCCpassed()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Este es mi primer comentario respuesta, espero que se vea bien......';
        // $use_com_id = '4';
        $ComId = '5';
        // $etiqueta1 = '';
        // $etiqueta2 = '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarComentR'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'ComId'=>$ComId
                                                                ]
                                )->assertRedirect('/profileServiceOccupation/2');

        // $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
              
        // $view->assertSessionDoesntHaveErrors(['comentario']);
        
    }

    public function test_errorValidation_postAnswer_TALpassed()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Este es mi segundo comentario respuesta, espero que se vea bien......';
        // $use_com_id = '4';
        $ComId = '6';
        // $etiqueta1 = '';
        // $etiqueta2 = '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarComentR'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'ComId'=>$ComId
                                                                        ]
                                )->assertRedirect('/profileServiceTalent/1');

        // $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
              
        // $view->assertSessionDoesntHaveErrors(['comentario']);
        
    }

    public function test_baseCreatePostAnswerOCC_validation()
    {
        $comentario = 'Este es mi primer comentario respuesta, espero que se vea bien......';
        $use_id = '7';
        $ComId = '5';

        $response = $this->assertDatabaseHas('answers', [
            'comentario'=>$comentario, 
            'use_id'=>$use_id,
            'use_com_id'=>$ComId 
    
        ]);
    }

    public function test_baseCreatePostAnswerTAL_validation()
    {
        $comentario = 'Este es mi segundo comentario respuesta, espero que se vea bien......';
        $use_id = '7';
        $ComId = '6';

        $response = $this->assertDatabaseHas('answers', [
            'comentario'=>$comentario, 
            'use_id'=>$use_id,
            'use_com_id'=>$ComId 
    
        ]);
    }

}
