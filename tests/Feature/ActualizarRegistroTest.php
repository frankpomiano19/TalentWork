<?php

namespace Tests\Feature;

//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use Illuminate\Http\Request;
use Illuminate\Http\Controllers\PerfilController;
use Illuminate\Http\Controllers\ServiceController;
use Tests\TestCase;

class ActualizarRegistroTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_perfil_view()
    {
        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);

        //$view = $this->view('perfil', compaq(auth()->user()->id));

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
                                )->assertRedirect('/perfil/7');

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);
              
        $view->assertSessionDoesntHaveErrors(['dni']);


        //$view->assertSee('djhfdjf');

            // $servOcu = ServiceOccupation::all();
            
            // $user = auth()->user();
            
            // $view = $this->view('perfil',compact( 'servOcu' , 'user' ));
                                
            // $view = $this->withViewErrors([
            //     'dni' => ['El campo dni es necesario.']
            // ])->view('perfil',compact( 'servOcu' , 'user' ));

            // $view->assertSee('El campo dni es necesario');
        //$response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
        // $this->assertContains('Realizado correctamente',[$response->getSession()->get('contractMessage')]);
        // $this->assertContains(302,[$response->getStatusCode()]);
    }

    public function test_errorValidationUpdate_EMAILdiferent()
    {
        //$this->withoutExceptionHandling();
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
                                )->assertRedirect('/perfil/7');

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
                                )->assertRedirect('/perfil/7');
        
        $this->assertContains('Realizado correctamente',[$response->getSession()->get('contractMessage')]);
        $this->assertContains(302,[$response->getStatusCode()]);
 
    }

    public function test_baseCreateUpdate_validation()
    {
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';
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

// public function test_errorValidationUpdate_data()
//     {
        //$this->withoutExceptionHandling();
                // $name = 'Frank';
                // $lastname = 'Alvarado Pardo';
                // $dni = '70900925';
                // $email = 'alvarado4@unmsm.edu.pe';
                // $birthdate = '2021-07-11 23:47:47';
                // $password = 'perrovaca';


        // $ID = '6';
        // $users = User::where('id',$ID)->get();

        // foreach ( $users as $user) {
            
        //     $correo = $user->email;
        //     $contraseña = $user->password;
        
        // };

        // $users = User::all();
        // $user = $users->find(6);
        // $user = User::where('id', 6)->get();
        //  $correo = $user->email;
        //  $contraseña = $user->password;

        //$response = $this->actingAs($user[0])->get('login');

        // $response = $this->post(route('login'), [
        //     'email' => $correo,
        //     'password' => $contraseña
        // ]);

        // $response = $this->post(route('login'), [
        //     'email' => 'klmn1234@ex',
        //     'password' => 'contraseña'
        // ])->assertRedirect('showOccupationService');

                // $credentials = [
                //     "email" => "alvarado4@unmsm.edu.pe",
                //     "password" => "perrovaca",
                // ];
                // $this->post('login', $credentials);

        //dd(auth()->user()->id);

        //DATOS SIMULADOS DEL REQUEST
        //$user = User::factory()->create();
        // $users = User::all();
        // $user = $users->find(6);
        
        // $user = User::find(6);
        //$id = $user->id;
        //if(){
            

        // }

                    // $response = $this->from('perfil')->put(route('update.user',auth()->user()->id), ['name'=>$name, 
                    //                                                                           'lastname'=>$lastname, 
                    //                                                                           'dni'=>$dni, 
                    //                                                                           'email'=>$email, 
                    //                                                                           'birthdate'=>$birthdate, 
                    //                                                                           'password'=>$password, 
                    //                                                                           'password_confirmation'=>$password]
                    //                         )->assertRedirect('/perfil/6');
                    
                    // $this->assertContains('Realizado correctamente',[$response->getSession()->get('contractMessage')]);
                    // $this->assertContains(302,[$response->getStatusCode()]);
        //dd($response->getStatusCode());

        //$response->assertStatus(302);

        //$response = $this->json('POST', 'registrarUsuario', ['name'=>'', 'lastname'=>'1234567'],
                                                //['Accept' => 'application/json']
                                //)->assertRedirect('registrouser');

        //$response->assertStatus(200);
        
        //$response->assertStatus(302);
        
        // $response = $this->assertCredentials([
        //     'name'=>$name, 
        //     'lastname'=>$lastname, 
        //     'dni'=>$dni, 
        //     'email'=>$email, 
        //     'birthdate'=>$birthdate, 
        //     'password'=>$password, 
        //     'password_confirmation'=>$password_confirmation
        // ]);       
        //$response = $this->assertRedirect('login');
        //$response->assertStatus(302);

        //$response->assertJsonValidationErrors(['name']);
        //$response->assertSessionHasErrors('name|lastname|dni|email|birthdate|password|password_confirmation');
        //$response->assertSessionHasErrors(['name','lastname','dni','email','birthdate','password','password_confirmation']);
    // }
