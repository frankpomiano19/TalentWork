<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use Livewire\Component;
use Auth;

class ChatUsuario extends Component
{
    public $mensaje = "";

    public $usuario;

    public $serviceProfile; 

    // public $vendedor;
    public $vendedo;
    public $client;

    public function enviarMensaje(){

        $this->emit("mensajeEnviado");

        $nuevo = new Mensajechat;
        $nuevo->cliente = Auth::user()->id;
        $nuevo->vendedor = $this->serviceProfile->use_id;
        $nuevo->mensaje = $this->mensaje;
        $nuevo->envia = Auth::user()->id;
        $nuevo->id_servicio = $this->serviceProfile->ser_occ_id;
        $nuevo->save();

        $this->reset('mensaje');
        
    }

    public function render()
    {
        $this->vendedo = $this->serviceProfile->use_id;
        $this->client = Auth::user()->id;
        $this->vendedo = $this->serviceProfile->use_id;
        $this->id_servici = $this->serviceProfile->ser_occ_id;

        return view('livewire.chat-usuario',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedo)
                ->where("cliente","=",$this->client)
                ->where("id_servicio","=",$this->id_servici)
            ->get()
        ]);

        // return view('livewire.chat-usuario');
    }
}
