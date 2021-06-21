<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\ServiceOccupation;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        if($id == auth()->user()->id){
        }
        $servOcu=ServiceOccupation::all();
        $user = User::where('id',$id)->first();
        return view('perfil', compact( 'servOcu' , 'user' ));
    }
}
