<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\Post_comment;
use App\Models\Question;
use App\Models\Answer;
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
    public function index()
    {
        return view('perfilservicio');
    }

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
        $comment = Post_comment::where('use_tal_id',$id)->first();
            //$usuarioBotica = User::where('id',$usuario->userFb->user_id)->first();
        // $comment = Post_comment::orderBy('id', 'DESC')->where('etiqueta2',$id)->paginate(14);
        // $question = Question::orderBy('id', 'DESC')->where('etiqueta_2',$id)->paginate(14);
        return view('servicioTalent',compact('serviceProfile', 'comment'));
    }



    public function showProfileServiceOccupation($id){
        $serviceProfile = use_occ::where('id',$id)->first();
        // $comment = Post_comment::orderBy('id', 'DESC')->where('etiqueta1',$id)->paginate(14);
        // $question = Question::orderBy('id', 'DESC')->where('etiqueta_1',$id)->paginate(14);
        //$comment = Post_comment::where('etiqueta',$id);
        return view('servicioOccupation',compact('serviceProfile'));
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
