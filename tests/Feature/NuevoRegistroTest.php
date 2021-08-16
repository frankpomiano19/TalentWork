<?php

namespace Tests\Feature;

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
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
    }

    public function test_errorValidation_data()
    {
        //$this->without_ExceptionHandling();
        $name = '';
        $lastname = '';
        $dni = '';
        $email = '';
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
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
    }

    public function test_errorValidation_passed()
    {
        $this->withoutExceptionHandling();
        $name = 'Anticaminante';
        $lastname = 'Apellido1 Apellido2';
        $dni = '32131231';
        $email = 'sincamino@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'contraseña';
        $password_confirmation = 'contraseña';

        $response = $this->from('registrouser')->post(route('registrarUsuario'), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password_confirmation]
                                );
                                $response->assertRedirect('login');

    }

    public function test_baseCreate_validation()
    {
        $name = 'Anticaminante';
        $lastname = 'Apellido1 Apellido2';
        $dni = '32131231';
        $email = 'sincamino@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';

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
