<?php

namespace App\Http\Controllers;

use App\Models\Change;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;

class ServiceController extends Controller
{
    public function registro(){
        $serviciosTec = ServiceOccupation::all();
        $serviciosTal = ServiceTalent::all();
        return view('registrodeServicio',compact('serviciosTec','serviciosTal'));
    }

    public function imageAddToCloud($image){
        $name = $image->getClientOriginalName();
        $image_name = $image->getRealPath();
        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(
                Cloudder::getPublicId(), 
                ["width" => $width, "height"=>$height]
        );
        $image->move(public_path("uploads"), $name);
        return $image_url;
    }
    public function registroReto(Request $request){
        $request->validate([
            'nombreReto' => 'required|max:100|min:5',
            'detallesReto' => 'required|max:2000|min:10',
            'costoReto' => 'required|between:100,10000|numeric',
            'imagenReto'=>'required|mimes:jpeg,bmp,jpg,png|between:1,6000'
        ]);
        $datosServicio = new use_occ;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_occ_id = 1;
        $datosServicio->descripcion = $request->detallesReto;
        $datosServicio->precio = $request->costoReto;
        $datosServicio->precio_actual = 0;
        $datosServicio->use_occ_group_payment = true;

        // Imagen en la nube
        $image_url = $this->imageAddToCloud($request->file('imagenReto'));

        $datosServicio->imagen = $image_url;
        $datosServicio->save();
        
        // Registro de reto
        DB::transaction(function () use($request,$datosServicio) {
            $datosServicio->save();
            $datosServicio->IntermediateChange()->create([
                'cha_name'=>$request->nombreReto,
            ]);                
        });
        $message = "Reto registrado exitosamente";
        return back()->with('serviceMessage',$message);
    }



    public function registroTecnico(Request $request){
        $request->validate([
            'servicioTecn' => 'required',
            'detallesTecn' => 'required|min:10',
            'costoTecn' => 'required|between:1,10000',
            'imagenTecn'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000'
        ]);

        $datosServicio = new use_occ;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_occ_id = $request->servicioTecn;
        $datosServicio->descripcion = $request->detallesTecn;
        $datosServicio->precio = $request->costoTecn;
        $image = $request->file('imagenTecn');

        $name = $request->file('imagenTecn')->getClientOriginalName();

        $image_name = $request->file('imagenTecn')->getRealPath();

        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), 
        ["width" => $width, "height"=>$height]);

        $image->move(public_path("uploads"), $name);

        $datosServicio->imagen = $image_url;
        $datosServicio->save();
        $message = "Servicio de ocupación registrado exitosamente";

        return back()->with('serviceMessage',$message);
    }

    public function registroTalento(Request $request){
        $request->validate([
            'servicioTalen' => 'required',
            'detallesTalen' => 'required|min:10',
            'costoTalen' => 'required|between:1,10000',
            'imagenTalen'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000'
        ]);

        $datosServicio = new use_tal;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_tal_id = $request->servicioTalen;
        $datosServicio->descripcion = $request->detallesTalen;
        $datosServicio->precio = $request->costoTalen;
        $image = $request->file('imagenTalen');

        $name = $request->file('imagenTalen')->getClientOriginalName();

        $image_name = $request->file('imagenTalen')->getRealPath();

        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(),
         ["width" => $width, "height"=>$height]);

        $image->move(public_path("uploads"), $name);

        $datosServicio->imagen = $image_url;
        $datosServicio->save();
        return back();
    }
}
