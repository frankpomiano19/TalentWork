<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use Livewire\Component;
use Auth;

class ChatTalents extends Component
{
    public $mensaje = "";
    public $usuario;
    public $serviceProfile; 
    public $vendedo;
    public $client;
    public $vendedor;
    public $id_servici;
    public $respuesta;


    protected $listeners = ['llegadaMensaje' => 'actualizaMensaje'];

    protected $rules = [
        'mensaje' => 'required|min:1'
    ];

    public function actualizaMensaje(){

        $this->client = Auth::user()->id;
        $this->vendedo = $this->serviceProfile->use_id;
        $this->id_servici = $this->serviceProfile->ser_tal_id;

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
        $nuevo->servicio = $this->serviceProfile->IntermediateTal->ser_tal_name;
        $nuevo->id_servicio = $this->serviceProfile->ser_tal_id;
        $nuevo->save();

        event(new \App\Events\MessageSent($this->vendedor,$this->respuesta));

        $this->emit('enviado');
        $this->reset('mensaje');
        
    }
    
    public function render()
    {
        $this->vendedo = $this->serviceProfile->use_id;
        $this->client = Auth::user()->id;
        $this->id_servici = $this->serviceProfile->ser_tal_id;

        return view('livewire.chat-talents',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedo)
                ->where("cliente","=",$this->client)
                ->where("id_servicio","=",$this->id_servici)
            ->get()
        ]);
    }
}
