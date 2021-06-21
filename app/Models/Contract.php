<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = [
        'con_contract_date',
        'con_hour',
        'con_address',
        'con_description',
        'con_price',
        'con_initial',
        'con_end',
        'use_offer',
        'use_receive',
        'ser_occ_id',
        'ser_tal_id',

    ];
    protected $hidden = [];    
}
