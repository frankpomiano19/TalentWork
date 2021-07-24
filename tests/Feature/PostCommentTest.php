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

class PostCommentTest extends TestCase
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

        $view->assertSee('Comenten sus opiniones sobre mis diseños, en especial los momos');
    }

    public function test_profileST_view()
    {
        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        //$view = $this->view('perfil', compaq(auth()->user()->id));

        $view->assertSee('Dejen sus opiniones sobre mis cuentos, no olviden dejar sus ideas para incluirlas en mis proximas historias');
    }

    public function test_errorValidation_postCommentFailed_OCC()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'ComFail';
        $value = '1';
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

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarComent'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'typeJobFromComment'=>$value, 
                                                                'serviceId'=>$allServices->id]
                                )->assertRedirect('/profileServiceOccupation/2');

        $response = $this->assertDatabaseMissing('Post_comments', [
                                    'comentario' => $comentario
                                ]);
                                //->assertRedirect('/profileServiceOccupation/3')
        
    }

    public function test_errorValidation_postCommentFailed_TAL()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'ComFail';
        $value = '2';
        // $usCom = 'Frank3';
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

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarComent'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'typeJobFromComment'=>$value, 
                                                                'serviceId'=>$allServices->id]
                                )->assertRedirect('/profileServiceTalent/1');

        $response = $this->assertDatabaseMissing('Post_comments', [
                                    'comentario' => $comentario
                                ]);
                                //->assertRedirect('/profileServiceOccupation/3')
        
    }

    public function test_errorValidation_postComment_OCC()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Este es mi primer comentario, espero que se vea bien......';
        $value= '1';
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

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarComent'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'typeJobFromComment'=>$value, 
                                                                'serviceId'=>$allServices->id]
                                )->assertRedirect('/profileServiceOccupation/2');

        // $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
              
        // $view->assertSessionDoesntHaveErrors(['comentario']);
        
    }

    public function test_errorValidation_postComment_TAL()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Mi segundo comentario, la verdad sigo sin saber que escribir......';
        $value= '2';
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

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarComent'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'typeJobFromComment'=>$value, 
                                                                'serviceId'=>$allServices->id]
                                )->assertRedirect('/profileServiceTalent/1');

        // $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
              
        // $view->assertSessionDoesntHaveErrors(['comentario']);
        
    }

    public function test_errorValidation_postComment_OCC_DEFAULT()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Comentario de prueba para ver que si funciona la ruta default';
        // $etiqueta1 = '';
        // $etiqueta2 = '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/2')->post(route('registrarComent'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id, 
                                                                'serviceId'=>$allServices->id]
                                )->assertRedirect('/profileServiceTalent/2');

        // $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
              
        // $view->assertSessionDoesntHaveErrors(['comentario']);
        
    }

    public function test_errorValidation_postComment_TAL_DEFAULT()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Comentario de prueba para ver que si funciona la ruta default';
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

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarComent'), [
                                                                'comentario'=>$comentario, 
                                                                'usCom'=>auth()->user()->id, 
                                                                'serviceId'=>$allServices->id]
                                )->assertRedirect('/profileServiceTalent/1');

        // $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
              
        // $view->assertSessionDoesntHaveErrors(['comentario']);
        
    }

    public function test_baseCreatePostCommentOCC_validation()
    {
        $comentario = 'Este es mi primer comentario, espero que se vea bien......';
        $use_id = '7';
        $use_occ_id ='2';

        $response = $this->assertDatabaseHas('Post_comments', [
                    'comentario'=>$comentario, 
                    'use_id'=>$use_id, 
                    'use_occ_id'=>$use_occ_id 
    
        ]);
    }

    public function test_baseCreatePostCommentTAL_validation()
    {
        $comentario = 'Mi segundo comentario, la verdad sigo sin saber que escribir......';
        $use_id = '7';
        $use_tal_id ='1';

        $response = $this->assertDatabaseHas('Post_comments', [
                    'comentario'=>$comentario, 
                    'use_id'=>$use_id, 
                    'use_tal_id'=>$use_tal_id
    
        ]);
    }
    
}
