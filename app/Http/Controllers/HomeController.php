<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\Contract;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

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

    public function showProfileServiceTalent($id){
        
        $serviceProfile = use_tal::where('id',$id)->first();

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
        return view('servicioTalent',compact('serviceProfile','chat'));
    }
    public function showProfileServiceOccupation($id){

        $serviceProfile = use_occ::where('id',$id)->first();


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
        return view('servicioOccupation',compact('serviceProfile','chat'));
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

        //return redirect('user/login');

        return redirect('/login');
        

    }
}
