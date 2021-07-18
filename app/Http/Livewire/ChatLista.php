<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use App\Models\User;
use Livewire\Component;

use Auth;

class ChatLista extends Component
{

    public $noda = "asd";

    public $vendedor = Auth::user()->id();


    public function render()
    {
        return view('livewire.chat-lista',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedor)
            ->get()
        ]);
    }
}
