<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\use_occ;
use App\Models\use_tal;

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

    public function test_errorValidation_postCommentFailed_OCC()
    {
        $comentario = '';
        $ComId = '1';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $this->from('/profileServiceOccupation/2')->post(route('registrarComentR'), [
                                                                'comentarioRespuesta'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'ComId'=>$ComId
                                                                ]
                                )->assertRedirect('/profileServiceOccupation/2');

        $this->assertDatabaseMissing('answers', [
                                    'comentario' => $comentario
                                ]);
        
    }
    /** @test */          
    public function errorValidation_postCommentFailed_TAL()
    {
        $comentario = '';
        $ComId = '3';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $this->from('/profileServiceTalent/1')->post(route('registrarComentR'), [
                                                                'comentarioRespuesta'=>$comentario, 
                                                                'usCom'=>auth()->user()->id,
                                                                'ComId'=>$ComId
                                                                        ]
                                );

        $this->assertDatabaseMissing('answers', [
                                    'comentario' => $comentario
                                ]);
        
    }

    public function test_errorValidation_postAnswer_OCCpassed()
    {
        //$this->withoutExceptionHandling();
        $comentario = 'Este es mi primer comentario respuesta, espero que se vea bien......';
        // $use_com_id = '4';
        $ComId = '1';
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
                                                                'comentarioRespuesta'=>$comentario, 
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
        $ComId = '3';
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
                                                                'comentarioRespuesta'=>$comentario, 
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
        $ComId = '1';

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
        $ComId = '3';

        $response = $this->assertDatabaseHas('answers', [
            'comentario'=>$comentario, 
            'use_id'=>$use_id,
            'use_com_id'=>$ComId 
    
        ]);
    }

}
