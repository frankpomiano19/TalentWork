<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class use_tal extends Model
{
    use HasFactory;
    protected $table = 'use_tals';
    public function IntermediateUseTal(){
        return $this->belongsTo(User::class,'use_id');
    }
    public function IntermediateTal(){
        return $this->belongsTo(ServiceOccupation::class,'ser_tal_id');
    }

}
