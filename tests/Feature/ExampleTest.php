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
        $this->get('/login')
        ->assertSee('login')
        ->assertStatus(200);

        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];

        $response = $this->post('login', $credentials);
        $response->assertRedirect('/occupationService');
        $this->assertCredentials($credentials);
        $response->assertSee('/occupationService');
    }

}
