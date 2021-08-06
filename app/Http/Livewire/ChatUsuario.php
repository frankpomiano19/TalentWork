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
    public $vendedo;
    public $vendedor;
    public $client;
    public $id_servici;
    public $respuesta;

    protected $listeners = ['llegadaMensaje' => 'actualizaMensaje'];

    protected $rules = [
        'mensaje' => 'required|min:1'
    ];

    public function actualizaMensaje(){

        $this->client = Auth::user()->id;
        $this->vendedo = $this->serviceProfile->use_id;
        $this->id_servici = $this->serviceProfile->ser_occ_id;

        $this->datos = Mensajechat::where("vendedor","=",$this->vendedo)
        ->where("cliente","=",$this->client)
        ->where("id_servicio","=",$this->id_servici)
        ->get();
    }

    public function enviarMensaje(){

        $validatedData = $this->validate();
        
        $nuevo = new Mensajechat;
        $nuevo->cliente = Auth::user()->id;
        $nuevo->vendedor = $this->serviceProfile->use_id;
        $nuevo->mensaje = $this->mensaje;
        $nuevo->envia = Auth::user()->id;
        $nuevo->fecha = now();
        $nuevo->servicio = $this->serviceProfile->IntermediateOcc->ser_occ_name;
        $nuevo->id_servicio = $this->serviceProfile->ser_occ_id;

        $nuevo->save();

        event(new \App\Events\MessageSent($this->vendedor,$this->respuesta));

        $this->emit('enviado');
        $this->reset('mensaje');
    }

    public function render()
    {
        $this->client = Auth::user()->id;
        $this->vendedo = $this->serviceProfile->use_id;
        $this->id_servici = $this->serviceProfile->ser_occ_id;

        return view('livewire.chat-usuario',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedo)
                ->where("cliente","=",$this->client)
                ->where("id_servicio","=",$this->id_servici)
            ->get()
        ]);
    }
}