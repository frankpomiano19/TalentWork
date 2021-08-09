<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\use_occ;
use App\Models\use_tal;

class PostQuestionTest extends TestCase
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
        $view->assertSee('Demora entre dos o tres días');
    }

    public function test_profileST_view()
    {
        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);
        $view->assertSee('No, por un tema de seguridad trabajamos de 8:00 am hasta las 6:00 pm');
    }

    public function test_errorValidation_postQuestionFailed_OCC()
    {
        //$this->withoutExceptionHandling();
        $pregunta = 'PregFail';
        $respuesta = 'RespFail';
        $value = '1';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarPreg'), [
                                                                'pregunta'=>$pregunta, 
                                                                'respuesta'=>$respuesta,
                                                                'typeJobFromQuestion'=>$value, 
                                                                'serviceId'=>$allServices->id 
                                                                ]
                                )->assertRedirect('/profileServiceOccupation/2');

        $response = $this->assertDatabaseMissing('questions', [
                                    'pregunta' => $pregunta,
                                    'respuesta' => $respuesta
                                ]);
        
    }

    public function test_errorValidation_postQuestionFailed_TAL()
    {
        //$this->withoutExceptionHandling();
        $pregunta = 'PregFail';
        $respuesta = 'RespFail';
        $value = '2';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarPreg'), [
                                                                'pregunta'=>$pregunta, 
                                                                'respuesta'=>$respuesta,
                                                                'typeJobFromQuestion'=>$value, 
                                                                'serviceId'=>$allServices->id
                                                                ]
                                );

        $response = $this->assertDatabaseMissing('questions', [
                                    'pregunta' => $pregunta,
                                    'respuesta' => $respuesta
                                ]);
        
    }

    public function test_errorValidation_postQuestion_OCC()
    {
        //$this->withoutExceptionHandling();
        $pregunta = 'Esta es mi primera pregunta, espero que se vea bien';
        $respuesta = 'Esta es mi primera respuesta, espero que se vea bien';
        $value = '1';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarPreg'), [
                                                                        'pregunta'=>$pregunta, 
                                                                        'respuesta'=>$respuesta,
                                                                        'typeJobFromQuestion'=>$value, 
                                                                        'serviceId'=>$allServices->id
                                                                        ]
                                )->assertRedirect('/profileServiceOccupation/2');
        
    }

    public function test_errorValidation_postQuestion_TAL()
    {
        //$this->withoutExceptionHandling();
        $pregunta = 'Esta es mi segunda pregunta, la verdad sigo sin saber que escribir......';
        $respuesta = 'Esta es mi segunda respuesta, la verdad sigo sin saber que escribir......';
        $value = '2';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarPreg'), [
                                                                        'pregunta'=>$pregunta, 
                                                                        'respuesta'=>$respuesta,
                                                                        'typeJobFromQuestion'=>$value, 
                                                                        'serviceId'=>$allServices->id
                                                                        ]
                                )->assertRedirect('/profileServiceTalent/1');
        
    }

    public function test_errorValidation_postQuestion_TAL_DEFAULT()
    {
        //$this->withoutExceptionHandling();
        $pregunta = 'Pregunta de prueba para ver que si funciona la ruta default';
        $respuesta = 'Respuesta de prueba para ver que si funciona la ruta default';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarPreg'), [
                                                                        'pregunta'=>$pregunta, 
                                                                        'respuesta'=>$respuesta,
                                                                        // 'typeJobFromQuestion'=>$value, 
                                                                        'serviceId'=>$allServices->id
                                                                        ]
                                );
        
    }

    public function test_errorValidation_postQuestion_OCC_DEFAULT()
    {
        //$this->withoutExceptionHandling();
        $pregunta = 'Pregunta de prueba para ver que si funciona la ruta default';
        $respuesta = 'Respuesta de prueba para ver que si funciona la ruta default';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/2')->post(route('registrarPreg'), [
                                                                        'pregunta'=>$pregunta, 
                                                                        'respuesta'=>$respuesta,
                                                                        // 'typeJobFromQuestion'=>$value, 
                                                                        'serviceId'=>$allServices->id
                                                                        ]
                                );
        
    }

    public function test_baseCreatePostQuestionOCC_validation()
    {
        $pregunta = 'Esta es mi primera pregunta, espero que se vea bien';
        $respuesta = 'Esta es mi primera respuesta, espero que se vea bien';
        $use_occ_id = '2';

        $response = $this->assertDatabaseHas('questions', [
                    'pregunta'=>$pregunta, 
                    'respuesta'=>$respuesta, 
                    'use_occ_id'=>$use_occ_id 
    
        ]);
    }

    public function test_baseCreatePostQuestionTAL_validation()
    {
        $pregunta = 'Esta es mi segunda pregunta, la verdad sigo sin saber que escribir......';
        $respuesta = 'Esta es mi segunda respuesta, la verdad sigo sin saber que escribir......';
        $use_tal_id = '1';

        $response = $this->assertDatabaseHas('questions', [
                    'pregunta'=>$pregunta, 
                    'respuesta'=>$respuesta, 
                    'use_tal_id'=>$use_tal_id 
    
        ]);
    }

}
