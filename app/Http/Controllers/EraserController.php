<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class EraserController extends Controller
{
    public function index()
    {
        $allUser = User::all();
        return view('welcome',compact('allUser'));
    }    
}
