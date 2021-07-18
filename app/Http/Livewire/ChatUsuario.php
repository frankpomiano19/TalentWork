<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use Livewire\Component;
use Auth;

class ChatUsuario extends Component
{
    public $test = "";
    public $mensaje = "";

    public $usuario;

    public $serviceProfile; 

    public function enviarMensaje(){

        $this->emit("mensajeEnviado");

        
        $nuevo = new Mensajechat;
        $nuevo->cliente = Auth::user()->id;
        $nuevo->vendedor = $this->serviceProfile->use_id;
        $nuevo->mensaje = $this->mensaje;
        $nuevo->id_servicio = $this->serviceProfile->ser_occ_id;
        $nuevo->save();

    }

    public function render()
    {
        return view('livewire.chat-usuario');
    }
}
