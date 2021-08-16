<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class ActualizarRegistroTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function test_perfil_view()
    {
        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        // ser_occ_name
        $this->post('login', $credentials);
        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);
        $view->assertSee('Frank');
    }


    public function test_errorValidationUpdate_DNIdiferent()
    {
        //$this->withoutExceptionHandling();
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '709009224';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);

        $response = $this->from('/perfil/7')->patch(route('update.user',auth()->user()->id), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password]
                                );

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);
              
        $view->assertSessionDoesntHaveErrors(['dni']);

    }

    public function test_errorValidationUpdate_EMAILdiferent()
    {
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'mantecoso@gmail.com';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $response = $this->from('/perfil/7')->patch(route('update.user',auth()->user()->id), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password]
                                );

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);
              
        $view->assertSessionDoesntHaveErrors(['email']);
        
    }


    public function test_errorValidationUpdate_data()
    {
        //$this->withoutExceptionHandling();
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $response = $this->from('/perfil/7')->patch(route('update.user',auth()->user()->id), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password]
                                );
        
        $this->assertContains('Realizado correctamente',[$response->getSession()->get('updateMessage')]);
        $this->assertContains(302,[$response->getStatusCode()]);
 
    }

    public function test_baseCreateUpdate_validation()
    {
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '82731232';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $response = $this->assertDatabaseHas('users', [
            'name'=>$name, 
            'lastname'=>$lastname, 
            'dni'=>$dni, 
            'email'=>$email, 
            'birthdate'=>$birthdate, 
        ]);
    }
}

