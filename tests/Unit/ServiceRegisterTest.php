<?php

namespace Tests\Unit;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\Tablon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class ServiceRegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     */

     use DatabaseTransactions;

    function test_view_ServiceRegister_page()
    {
        $serviciosTec = ServiceOccupation::all();
        $serviciosTal = ServiceTalent::all();
        $this->get('registroServicio')
            ->assertStatus(200);
        $view = $this->view('registroServicio',compact('serviciosTec','serviciosTal'));
        //Comprobación de que exite un servicio tecnico
        $view->assertSee('Reparador de computadoras');
        //Comprobación de que exite un servicio de talento
        $view->assertSee('Abridor de cajas');
        
    }

    function test_post_ServiceRegister_Ocupation(){
        Auth::loginUsingId(2);
        $imagen = UploadedFile::fake()->image('avatar.jpg', '200', '200')->size(100);
        $occupationDetails = 'bla bla bla';
        $occupationPrice = 140;

        $this->post(route('servicio.tecnico'), [
            'servicioTecn' => 1,
            'detallesTecn' => $occupationDetails,
            'costoTecn' => $occupationPrice,
            'imagenTecn' => $imagen,
        ]);
        $this->assertDatabaseHas('use_occs',[
            'descripcion'=>$occupationDetails,
            'precio'=>$occupationPrice
        ]);
    }

    function test_post_ServiceRegister_Ocupation_without_login(){
        $response = $this->post(route('servicio.tecnico'), [
            'servicioTecn' => 'Gasfitero de madrigueras',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect('/login');
    }

    function test_post_ServiceRegister_Talent(){

        Auth::loginUsingId(2);
        $imagen = UploadedFile::fake()->image('avatar.jpg', '200', '200')->size(100);
        $talentDetails = 'bla bla bla';
        $talentPrice = 140;
        $response = $this->post(route('servicio.talento'), [
            'servicioTalen' => 1,
            'detallesTalen' => $talentDetails,
            'costoTalen' => $talentPrice,
            'imagenTalen' => $imagen,
        ]);
        $this->assertDatabaseHas('use_tals',[
            'descripcion'=>$talentDetails,
            'precio'=>$talentPrice
        ]);
        $response->assertRedirect('/');
    }

    function test_post_ServiceRegister_Talent_without_login(){

        $response = $this->post(route('servicio.talento'), [
            'servicioTecn' => 'Narrador de Audiolibros',
            'detallesTecn' => 'bla bla bla',
            'costoTecn' => '123',
            'imagenTecn' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect('/login');
    }


    /** @test */    
    public function showChangeService()
    {
        $view = $this->get(route('showRetoService'));
        $view->assertStatus(200);
    }

    /** @test */    
    public function showProfileServiceChange()
    {
        $view = $this->get(route('showProfileServiceRetos',2));
        $view->assertStatus(200);
        $view->assertSee('Reto de bailarin');
    }

    /** @test */
    public function deleteBoard(){
        Auth::loginUsingId(1);
        $this->post(route('tablon.servicio'), [
            'nombre' => 'Casa elegante de meneo',
            'descripcion' => 'Simplemente limpiando la suciedad',
            'precio' => '24.98',
            'tipo' => 'Talento',
        ]);
        $view = $this->delete(route('servicio.destroy',1));
        $view->assertStatus(302);
        $this->assertContains('ok',[$view->getSession()->get('eliminado')]);
    }    

}
