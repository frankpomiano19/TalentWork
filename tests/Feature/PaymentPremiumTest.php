<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentPremiumController;
use App\Models\User;

class PaymentPremiumTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function test_payment_premium()
    {
        $processPayment = new PaymentPremiumController();
        $credential = [
            "email" => "pato@gmail.com",
            "password" => "password",
        ];
        Storage::fake('avatars');
        $this->post('login', $credential);
        $requestServices = new Request([
        ]);
        $responses = $processPayment->processPaymentPremiumStripe($requestServices);
        $this->assertContains('El pago fue ejecutado correctamente, ahora es un usuario Premium',
        [$responses->getSession()->get('statusPaymentSuccess')]);
        
    }
}
