<?php

namespace Tests\Unit;

use App\Models\Change;
use Tests\TestCase;
use App\Models\Contract;
use App\Models\Mensajechat;
use App\Models\Message;
use App\Models\use_occ;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ModelsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    /** @test */    
    public function contractRelations()
    {   
        $contract = Contract::findOrFail(1);
        $this->assertInstanceOf(use_occ::class,$contract->IntermediateUseOcc);
    }

    /** @test */    
    public function occupationRelations()
    {
        $occupation = use_occ::findOrFail(2);        
        $this->assertInstanceOf(Change::class,$occupation->IntermediateChange);
    }
    
    /** @test */   
    public function userRelation(){
        $user = User::findOrFail(2);
        $this->assertInstanceOf(Contract::class,$user->UseContractOffer[0]);
        Message::create([
            'user_id'=>$user->id,
            'message'=>'My first message.Hi there'
        ]);
        $this->assertInstanceOf(Message::class,$user->messages[0]);
        // Message Relation
        $this->assertInstanceOf(User::class,$user->messages[0]->user);
        
    } 

    /** @test */   
    public function mensajeChatRelation(){
        $messageChat = Mensajechat::create([
            'cliente'=>1,
            'vendedor'=>2,
            'mensaje'=>'Fly in the sky',
            'id_servicio'=>1,
            'envia'=>1,
            'fecha'=>Carbon::now()
        ]);
        $this->assertInstanceOf(User::class,$messageChat->IntermediateUser);
    }
}
