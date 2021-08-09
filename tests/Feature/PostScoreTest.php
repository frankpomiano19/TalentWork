<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\use_occ;
use App\Models\use_tal;

class PostScoreTest extends TestCase
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

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);
        $view->assertSee('Califica este servicio');
    }

    public function test_profileST_view()
    {
        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);
        $view->assertSee('Califica este servicio');
    }
    
    public function test_postScoreNull_OCC()
    {
        //$this->withoutExceptionHandling();
        $calificacion = null;
        $value= '1';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarScore'), [ 
                                                                    'calificacion' => $calificacion,
                                                                    'usCom' => auth()->user()->id,
                                                                    'typeJobFromScore' => $value,
                                                                    'serviceId' => $allServices->id,
                                                                    'etiqueta'=> 'comentado',]
                                )->assertRedirect('/profileServiceOccupation/2');

        // $response = $this->assertDatabaseMissing('Post_comments', [
        //                             'comentario' => $comentario
        //                         ]);
        
    }

    public function test_postScoreNull_TAL()
    {
        //$this->withoutExceptionHandling();
        $calificacion = null;
        $value= '2';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarScore'), [ 
                                                                    'calificacion' => $calificacion,
                                                                    'usCom' => auth()->user()->id,
                                                                    'typeJobFromScore' => $value,
                                                                    'serviceId' => $allServices->id,
                                                                    'etiqueta'=> 'comentado',]
                                )->assertRedirect('/profileServiceTalent/1');

        // $response = $this->assertDatabaseMissing('Post_comments', [
        //                             'comentario' => $comentario
        //                         ]);
        
    }

    public function test_postScoreData_OCC()
    {
    
        $calificacion = 4;
        $value= '1';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarScore'), [ 
                                                                    'calificacion' => $calificacion,
                                                                    'usCom' => auth()->user()->id,
                                                                    'typeJobFromScore' => $value,
                                                                    'serviceId' => $allServices->id,
                                                                    'etiqueta'=> 'comentado',]
                                )->assertRedirect('/profileServiceOccupation/2');
        
    }

    public function test_postScoreData_TAL()
    {
        //$this->withoutExceptionHandling();
        $calificacion = 3;
        $value= '2';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarScore'), [ 
                                                                    'calificacion' => $calificacion,
                                                                    'usCom' => auth()->user()->id,
                                                                    'typeJobFromScore' => $value,
                                                                    'serviceId' => $allServices->id,
                                                                    'etiqueta'=> 'comentado',]
                                )->assertRedirect('/profileServiceTalent/1');
        
    }

    public function test_postScoreDefault_OCC()
    {
        //$this->withoutExceptionHandling();
        $calificacion = 5;
        $value= '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '2';
        $allServices = use_occ::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceOccupation',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceOccupation/2')->post(route('registrarScore'), [ 
                                                                    'calificacion' => $calificacion,
                                                                    'usCom' => auth()->user()->id,
                                                                    'typeJobFromScore' => $value,
                                                                    'serviceId' => $allServices->id,
                                                                    'etiqueta'=> 'comentado',]
                                );
        
        $response = $this->assertDatabaseMissing('Scores', [
                                    'calificacion' => $calificacion
                                ]);
        
    }

    public function test_postScoreDefault_TAL()
    {
        //$this->withoutExceptionHandling();
        $calificacion = 5;
        $value= '';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $id = '1';
        $allServices = use_tal::where('id',$id)->first();

        $view = $this->get(route('showProfileServiceTalent',$allServices->id))->assertStatus(200);

        $response = $this->from('/profileServiceTalent/1')->post(route('registrarScore'), [ 
                                                                    'calificacion' => $calificacion,
                                                                    'usCom' => auth()->user()->id,
                                                                    'typeJobFromScore' => $value,
                                                                    'serviceId' => $allServices->id,
                                                                    'etiqueta'=> 'comentado',]
                                );

        $response = $this->assertDatabaseMissing('Scores', [
                                    'calificacion' => $calificacion
                                ]);

    }

    public function test_baseCreatePostScoreOCC_validation()
    {
        $calificacion = 0;
        $use_id = '7';
        $use_occ_id ='2';
        $etiqueta = 'comentado';

        $response = $this->assertDatabaseHas('Scores', [
                    'calificacion'=>$calificacion, 
                    'use_id'=>$use_id, 
                    'use_occ_id'=>$use_occ_id,
                    'etiqueta'=>$etiqueta 
    
        ]);
    }

    public function test_baseCreatePostScoreTAL_validation()
    {
        $calificacion = 3;
        $use_id = '7';
        $use_tal_id ='1';
        $etiqueta = 'comentado';

        $response = $this->assertDatabaseHas('Scores', [
                    'calificacion'=>$calificacion, 
                    'use_id'=>$use_id, 
                    'use_tal_id'=>$use_tal_id,
                    'etiqueta'=>$etiqueta 
    
        ]);
    }

}
