<?php

namespace App\Http\Livewire;
use Livewire\Component;
//use App\Contact as Contactos;
use App\Models\Mensajechat as MensajeTabla;

class Chat extends Component
{
    public $mensaje;
    public $mensajeChat;

    public $de;
    public $para;

    public $serviceProfile;

    public function enviarMensaje()
    {   


    }

    public function submit() {


        //dd($this->serviceProfile->id);
        
        /*$mensajeA->de = auth()->user()->id;
        $mensajeA->para = $this->serviceProfile->IntermediateUseOcc->id;
        $mensajeA->mensaje = $this->mensajeChat;
        $mensajeA->id_servicio = $this->serviceProfile->id;
        $mensajeA -> save();
        */

        MensajeTabla::create([
            'de' => auth()->user()->id,
            'para' => $this->serviceProfile->IntermediateUseOcc->id,
            'mensaje' => $this->mensajeChat,
            'id_servicio' => $this->serviceProfile->id
        ]);
        //dd($de,$para);

        //$this->mensajechat = "";
        //dd(auth()->user()->id);
    }

    public function render()
    {

        return view('livewire.chat',[
            'historial' => MensajeTabla::where("de","=",auth()->user()->id)
                ->where("para","=",$this->serviceProfile->IntermediateUseOcc->id)
                ->where("id_servicio","=",$this->serviceProfile->id)
                ->orWhere(function($query){
                    $query->where("para","=",auth()->user()->id)
                        ->where("id_servicio","=",$this->serviceProfile->id);
                })
                ->get()
        ]);

    }
}
