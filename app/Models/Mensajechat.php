<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensajechat extends Model
{
    use HasFactory;
    protected $table = 'mensajeschats';
    protected $fillable = [
        'de',
        'para',
        'mensaje',
        'id_servicio'
    ];
}
