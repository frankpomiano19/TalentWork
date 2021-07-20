<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_comment extends Model
{
    use HasFactory;
    protected $table = 'Post_comments';

    protected $fillable = [
        //'comentario', 'us_com', 'serpro_id'
        'comentario', 'us_com', 'etiqueta1', 'etiqueta2'
    ];

}
