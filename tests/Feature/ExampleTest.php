<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;


class ExampleTest extends TestCase
{
    //use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$user = User::where('email', 'presidente@gmail.com')->first();
        //dd(auth()->id());
        //$response = $this->get('/login');
        //$response->assertStatus(200);
        //$response->assertSee('login');

        $this->get('/login')->assertSee('login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];

        $response = $this->post('login', $credentials);
        dd(auth()->user()->id);
        $this->assertCredentials($credentials);
        //$response->assertStatus(200);
        $response->assertSee('/');
        


        //$response->assertRedirect('login');
        // $this->assertCredentials($credentials);

    }

}
