<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use App\Exceptions\Handler;
use Tests\TestCase;

class NuevoRegistroTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_errorValidation_null()
    {
        //$this->withoutExceptionHandling();

        $response = $this->from('registrouser')->post(route('registrarUsuario'), [])->assertRedirect('registrouser');
        //$response = $this->json('POST', 'registrarUsuario', ['name'=>'', 'lastname'=>'1234567'],
                                                //['Accept' => 'application/json']
                                //)->assertRedirect('registrouser');

        $response->assertStatus(302);

        //$response->assertJsonValidationErrors(['name']);
        //$response->assertSessionHasErrors('name|lastname|dni|email|birthdate|password|password_confirmation');
        $response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
    }

    public function test_errorValidation_data()
    {
        //$this->without_ExceptionHandling();
        $name = 'frank';
        $lastname = '';
        $dni = '';
        $email = 'frank_a.pardo_2017@hotmail.com';
        $birthdate = '';
        $password = '';
        $password_confirmation = '';

        $response = $this->from('registrouser')->post(route('registrarUsuario'), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password_confirmation]
                                )->assertRedirect('registrouser');
        //$response = $this->json('POST', 'registrarUsuario', ['name'=>'', 'lastname'=>'1234567'],
                                                //['Accept' => 'application/json']
                                //)->assertRedirect('registrouser');

        //$response->assertStatus(201);
        $response->assertStatus(302);

        //$response->assertJsonValidationErrors(['name']);
        //$response->assertSessionHasErrors('name|lastname|dni|email|birthdate|password|password_confirmation');
        $response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
    }

    // public function test_errorValidation_passed()
    // {
    //     $this->withoutExceptionHandling();
    //     $name = 'Frank';
    //     $lastname = 'Alvarado Pardo';
    //     $dni = '70900900';
    //     $email = 'vladimir12.alvarado@unmsm.edu.pe';
    //     $birthdate = '1997-08-20';
    //     $password = '959146547';
    //     $password_confirmation = '959146547';

    //     $response = $this->from('registrouser')->post(route('registrarUsuario'), ['name'=>$name, 
    //                                                                               'lastname'=>$lastname, 
    //                                                                               'dni'=>$dni, 
    //                                                                               'email'=>$email, 
    //                                                                               'birthdate'=>$birthdate, 
    //                                                                               'password'=>$password, 
    //                                                                               'password_confirmation'=>$password_confirmation]
    //                             )->assertRedirect('login');
    //     //$response = $this->json('POST', 'registrarUsuario', ['name'=>'', 'lastname'=>'1234567'],
    //                                             //['Accept' => 'application/json']
    //                             //)->assertRedirect('registrouser');

    //     //$response->assertStatus(200);
    //     $response->assertStatus(302);
    //     //$response = $this->assertRedirect('login');
    //     //$response->assertStatus(302);

    //     //$response->assertJsonValidationErrors(['name']);
    //     //$response->assertSessionHasErrors('name|lastname|dni|email|birthdate|password|password_confirmation');
    //     //$response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
    // }

    public function test_baseCreate_validation()
    {
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'vladimir20.alvarado@unmsm.edu.pe';
        $birthdate = '1997-08-20';
        //$password = '959146547';
        //$password_confirmation = '959146547';

        $response = $this->assertDatabaseHas('users', [
            'name'=>$name, 
            'lastname'=>$lastname, 
            'dni'=>$dni, 
            'email'=>$email, 
            'birthdate'=>$birthdate, 
            //'password'=>bcrypt($password), 
            //'password_confirmation'=>bcrypt($password)
        ]);
    }

}
