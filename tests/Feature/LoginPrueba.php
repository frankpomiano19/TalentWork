<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPrueba extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function prueba_login()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSee('login');
        
        $response = $this->get('login');

        $response->assertStatus(200);

        $this->get('/login')->assertSee('login');
        $credentials = [
            "email" => "vizcarra@gmail.com",
            "password" => "vacassss"
        ];

        $response = $this->post('/login', $credentials);
        $response->assertRedirect(true);
        $this->assertCredentials($credentials);
    }
}
