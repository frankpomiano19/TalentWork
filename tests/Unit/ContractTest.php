<?php

namespace Tests\Unit;

use App\Http\Controllers\ContractController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use PHPUnit\Framework\TestCase;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;



class ContractTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use WithoutMiddleware;
    /** @test */
    public function testCreateContract()
    {
        
    }


}
