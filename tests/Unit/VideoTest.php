<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

     use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    /** @test */    
    public function uploadLinkVideo(){
        Auth::loginUsingId(2);        
        $instanceVideo =  new VideoController();
        $request = new Request([
            'urlVideo' => 'https://www.youtube.com/watch?v=HzTc6u9P4WE',
            'idService'=>'2'
        ]);
        $instanceVideo->videoUpload($request);
        $this->assertDatabaseHas('changes',[
            'cha_video'=>$request->urlVideo,
            'cha_25_percent_active'=>true
        ]);
    }
}
