<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\Contract;
use App\Models\Post_comment;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tablon;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TablonRequest;

use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function showTalentService(){
        $allServices = use_tal::orderBy('created_at','DESC')->paginate(20);
        return view('profileServiceTalent',compact('allServices'));
    }   

    public function showOccupationService(){
        $allServices = use_occ::orderBy('created_at','DESC')->paginate(20);
        return view('profileServiceOccupation',compact('allServices'));
    }

    public function TablonServicios(){

        $talentos = ServiceTalent::all();
        $ocupaciones = ServiceOccupation::all();
        $servicios = Tablon::all();
        return view('tablonservicios')->with('talentos', $talentos)->with('ocupaciones', $ocupaciones)->with('servicios', $servicios);

    }

    public function solicitarServicio(TablonRequest $request){

        $talentos = ServiceTalent::all();
        $ocupaciones = ServiceOccupation::all();

        $servicioNuevo = new App\Models\Tablon;

        $servicioNuevo->servicio = $request->nombre;
        $servicioNuevo->descripcion = $request->descripcion;;
        $servicioNuevo->precio = $request->precio;
        $servicioNuevo->tipo = $request->tipo;
        $servicioNuevo->use_id = auth()->id();
        $servicioNuevo -> save();

        $servicios = Tablon::all();
        
        return redirect()->route('tablonservicios')->with('agregado', 1)->with('talentos', $talentos)->with('ocupaciones', $ocupaciones)->with('servicios', $servicios);
    }

    public function eliminarServicio($id)
    {
        $servicio = Tablon::find($id);
        $servicio->delete();
        return back()->with('eliminado','ok');
    }

    public function showProfileServiceTalent($id){
        
        $serviceProfile = use_tal::where('id',$id)->first();
        $SerTal = use_tal::orderBy('created_at','DESC')->skip(0)->take(5)->get();
        $SerOcc = use_occ::orderBy('created_at','DESC')->skip(0)->take(5)->get();

        if(auth()->user()==null){
            $chat = false;
        }else{
            $estadoContrato = Contract::where('use_tal_id',$id)
                                ->where('use_receive',auth()->user()->id)            
                                ->first();

            if($estadoContrato){
                $contratado = $estadoContrato->con_status;
                if($contratado == "1"){
                    $chat = true;
                }
            }else{
                $chat = false;
            }
        }
        return view('servicioTalent',compact('serviceProfile','chat','SerTal','SerOcc'));
    }



    public function showProfileServiceOccupation($id){

        $serviceProfile = use_occ::where('id',$id)->first();
        $SerOcc = use_occ::orderBy('created_at','DESC')->skip(0)->take(5)->get();
        $SerTal = use_tal::orderBy('created_at','DESC')->skip(0)->take(5)->get();

        if(auth()->user()==null){
            $chat = false;
        }else{
            $estadoContrato = Contract::where('use_occ_id',$id)
                                ->where('use_receive',auth()->user()->id)            
                                ->first();
            if($estadoContrato){
                $contratado = $estadoContrato->con_status;
                if($contratado == "1"){
                    $chat = true;
                }
            }else{
                $chat = false;
            }
        }
        return view('servicioOccupation',compact('serviceProfile','chat','SerOcc','SerTal'));
    }

    public function nuevoRegistro(Request $request){
        $request->validate([
            'name'=>'required',
            'lastname'=>'required|string|max:100',
            'dni'=>'required|string|min:8|max:8|unique:users,dni',
            'email'=>'required|email|unique:users,email',
            'birthdate'=>'required',
            'password'=>'required|string|max:25|confirmed',
            'password_confirmation'=>'required|string|max:25',
        ]);
        $user = new User(array(
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'DNI' => $request->get('dni'),
            'email' => $request->get('email'),
            'birthdate' => $request->get('birthdate'),
            'password' => bcrypt($request->get('password')),
            'password_confirmation' => bcrypt($request->get('password_confirmation'))
        ));

        $user->save();

        
        return redirect()->route('login');
        

    }
}
