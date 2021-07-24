<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
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

        // $credentials = [
        //     "email" => "vizcarra@gmail.com",
        //     "password" => "vacassss"
        // ];

        // $response = $this->post('login', $credentials);
        // $response->assertRedirect('/occupationService');
        // $this->assertCredentials($credentials);
        // $response->assertSee('/occupationService');
    }
}
