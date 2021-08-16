<?php

namespace Tests\Feature;

use App\Http\Controllers\PaymentPremiumController;
use App\Models\use_occ;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */  
    public function processPaymentStripeTest()
    {
        Auth::loginUsingId(2);
        $data = [
            'serviceOffer'=>2,
            'cantidadMeta'=>500,
            'cantidadActual'=>10,
            'cantidadDonacion'=>100

        ];
        $this->post(route('proccessPaymentStripe2',$data))->assertStatus(302);
    }

    /** @test */  
    public function paymentStripeSuccessChange(){
        Auth::loginUsingId(2);
        $data = [
            'serviceOffer'=>2,
            'cantidadMeta'=>600,
            'cantidadActual'=>10,
            'cantidadDonacion'=>590,
            'typeOfJob'=>1

        ];
        $this->post(route('proccessPaymentStripe2',$data))->assertStatus(302);
        $this->assertDatabaseHas('changes',[
            'ser_occ_change'=>2,
            'cha_active'=>false
        ]);
    }
}
