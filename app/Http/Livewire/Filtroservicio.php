<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\User;

class Filtroservicio extends Component
{

    public $ocupacion;
    public $talento;
    public $precioMin = 100000;
    public $calificacion;
    public $talentoS = false;
    public $ocupacionS = false;
    public $tipo = "";

    public function talentoM()
    {
        $this->talentoS = true;
        $this->ocupacionS = false;
    }
    public function ocupacionM()
    {
        $this->talentoS = false;
        $this->ocupacionS = true;
    }

    public function render()
    {
        if($this->talentoS){
            $this->tipo = "Talentos";
            return view('livewire.filtroservicio',[
                'datos' => use_tal::where("ser_tal_id","=", $this->talento)
                    ->where("precio","<=", $this->precioMin)
                    ->where("precio",">",0)
                    //->orderBy('calificacion', $this->calificacion)
                    ->get()],['tipo' => $this->tipo]);
        }else{
            $this->tipo = "Ocupaciones";
            return view('livewire.filtroservicio',[
                'datos' => use_occ::where("ser_occ_id","=", $this->ocupacion)
                    ->where("precio",">",0)
                    ->where("precio","<=", $this->precioMin)
                    //->orderBy('calificacion', $this->calificacion)
                    ->get()],['tipo' => $this->tipo]);
        }
    }
}