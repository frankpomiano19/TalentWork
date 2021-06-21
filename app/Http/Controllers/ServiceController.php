<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;


class ServiceController extends Controller
{
    public function registro(){
        $serviciosTec = ServiceOccupation::all();
        $serviciosTal = ServiceTalent::all();
        return view('registroServicio',compact('serviciosTec','serviciosTal'));
    }

    public function registroTecnico(Request $request){
        $datosServicio = new use_occ;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_occ_id = $request->servicioTecn;
        $datosServicio->save();
        return back();
    }

    public function registroTalento(Request $request){
        $datosServicio = new use_tal;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_tal_id = $request->servicioTalen;
        $datosServicio->save();
        return back();
    }
}
