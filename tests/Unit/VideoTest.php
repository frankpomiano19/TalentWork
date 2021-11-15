<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VideoController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\ValidationException;

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

    /** @test */    
    public function uploadLinkVideoNotRequiredService(){
        
        Auth::loginUsingId(2);        
        $instanceVideo =  new VideoController();
        
        $request = new Request([
            'urlVideo' => 'https://www.youtube.com/watch?v=HzTc6u9P4WE',
        ]);
        try{
            $instanceVideo->videoUpload($request);
        }catch(ValidationException $e){
            $error = $e->errors();
            $this->assertArrayHasKey('idService',$error);
        }   
    }
    /** @test */    
    public function uploadLinkVideoNotRequireUrl(){
        Auth::loginUsingId(2);        
        $instanceVideo =  new VideoController();
        
        $request = new Request([
            'idService'=>'2'
        ]);
        try{
            $instanceVideo->videoUpload($request);
        }catch(ValidationException $e){
            $error = $e->errors();
            $this->assertArrayHasKey('urlVideo',$error);
        }   
    }

    /** @test */    
    public function uploadLinkVideoNotUrl(){
        Auth::loginUsingId(2);        
        $instanceVideo =  new VideoController();
        
        $request = new Request([
            'urlVideo' => 'www.you',
            'idService'=>'2'
        ]);
        try{
            $instanceVideo->videoUpload($request);
        }catch(ValidationException $e){
            $error = $e->errors();
            $this->assertArrayHasKey('urlVideo',$error);
        }   
    }
    /** @test */    
    public function uploadLinkVideoMax(){
        Auth::loginUsingId(2);        
        $instanceVideo =  new VideoController();
        
        $request = new Request([
            'urlVideo' =>'https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WEhttps://www.youtube.com/watch?v=HzTc6u9P4WE
            https://www.youtube.com/watch?v=HzTc6u9P4WE',
            'idService'=>'2'
        ]);
        try{
            $instanceVideo->videoUpload($request);
        }catch(ValidationException $e){
            $error = $e->errors();
            $this->assertArrayHasKey('urlVideo',$error);
        }   

    }
    /** @test */    
    public function uploadLinkVideoNotNotFormat(){
        Auth::loginUsingId(2);        
        $instanceVideo =  new VideoController();
        
        $request = new Request([
            'urlVideo' => 'https://www.instagram',
            'idService'=>'2'
        ]);
        try{
            $instanceVideo->videoUpload($request);
        }catch(ValidationException $e){
            $error = $e->errors();
            $this->assertArrayHasKey('urlVideo',$error);
        }   
    }


}
