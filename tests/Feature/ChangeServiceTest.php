<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use function PHPUnit\Framework\assertContains;

class ChangeServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    /** @test */        
    public function postServiceRegisterChange(){
        Auth::loginUsingId(1);
        define('CHANGE_NAME','Bailando en inglaterra');
        $imagen = UploadedFile::fake()->image('avatar.jpg', '200', '200')->size(100);
        $response = $this->post(route('servicio.reto'), [
            'nombreReto' => CHANGE_NAME,
            'detallesReto' => 'Bailare hasta que me salgan callos en los pues',
            'costoReto' => 800,
            'imagenReto' => $imagen,
        ]);
        $this->assertDatabaseHas('changes',[
            'cha_name'=>CHANGE_NAME
        ]);
        $this->assertContains('Reto registrado exitosamente',[$response->getSession()->get('serviceMessage')]);
    }

}
