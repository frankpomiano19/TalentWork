<?php

namespace Tests\Feature;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VideoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VideoTest extends TestCase
{
    const email = "pato@gmail.com";
    const password = "password" ;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function setImageCloud(){
        $this->sessionAutenticacion(self::email,self::password);
        $imagen = UploadedFile::fake()->image('avatar.jpg', '200', '200')->size(100);
        $serviceController = new ServiceController();
        $request = new Request([
            'nombreReto'=>'nuevo reto 2',
            'detallesReto'=>'Nuevos detalles del reto',
            'costoReto'=>400,
            'imagenReto'=>$imagen

        ]);
        $response = $serviceController->imageAddToCloud($imagen);
        // $response = $serviceController->registroReto($request);
        // $response->assertSessionHasErrors(['nombreReto','detallesReto','costoReto','imagenReto']) ;       
    }


    // public function insertVideoLink()
    // {
    //     $response = $this->get('/');
    //     $videoController = new VideoController();

    //     $videoController->videoUpload(new Request([
    //         'urlVideo'=>"vaciones",
    //         'idService'=>'1'
    //     ]));
    //     $response->assertStatus(200);
    // }
    public function sessionAutenticacion($email, $password){
        $credentials = [
            "email" => $email,
            "password" => $password,
        ];
        $this->post('login', $credentials);
    }    
}
