<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentPremiumController;


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
