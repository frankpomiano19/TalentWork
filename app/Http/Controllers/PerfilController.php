<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\ServiceOccupation;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $servOcu=ServiceOccupation::all();
        $user=Auth::user();
        return view('perfil', compact( 'servOcu' , 'user' ));
    }
}
