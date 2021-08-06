<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\Tablon;

class TablonServicio extends Component
{
    public $nombre = "maaanue";

    public function render()
    {
        return view('livewire.tablon-servicio',[
            'talentos' => ServiceTalent::all()
        ],[
            'ocupaciones' => ServiceOccupation::all()
        ],
        [
            'datos' => Tablon::all()
        ]
        );
    }
}
