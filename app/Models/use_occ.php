<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class use_occ extends Model
{
    use HasFactory;

    protected $table = 'use_occs';

    public function IntermediateUseOcc(){
        return $this->belongsTo(User::class,'use_id');
    }
    public function IntermediateOcc(){
        return $this->belongsTo(ServiceOccupation::class,'ser_occ_id');
    }
    public function IntermediateOccContract(){
        return $this->hasMany(Contract::class,'use_occ_id');
    }

}
