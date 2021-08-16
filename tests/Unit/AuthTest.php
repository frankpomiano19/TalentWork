<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    /** @test */   
    public function confirmPasswordTest()
    {
        $instanceOfConfirmPassword = new ConfirmPasswordController();
        $this->assertObjectHasAttribute('redirectTo',$instanceOfConfirmPassword);
    }

    /** @test */   
    public function verificationEmailTest()
    {
        $instanceOfVerificationEmail = new VerificationController();
        $this->assertObjectHasAttribute('middleware',$instanceOfVerificationEmail);
    }
}
