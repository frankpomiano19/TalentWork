<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Models\User;
use App\Models\use_occ;
use App\Models\Post_comment;
use App\Models\Question;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function newComment(Request $request){

        $request->validate([
            'comentario'=>'required|string|min:10|max:170',
        ]);
        
        $comment = new Post_comment(array(
            'comentario' => $request->get('comentario'),
            'us_com' => $request->get('us_com'),
            'etiqueta1' => $request->get('etiqueta1'),
            'etiqueta2' => $request->get('etiqueta2'),
                //'pregunta' => $request->get('pregunta'),
                //'respuesta' => $request->get('respuesta')
            //'serpro_id' => $request->get('serpro_id'),
        ));

        $comment->save();

        return redirect()->back();
    }

    public function newQuestion(Request $request){

        $request->validate([
            'pregunta'=>'required|string|min:10|max:170',
            'respuesta'=>'required|string|min:10|max:170',
        ]);
        
        $question = new Question(array(
            'pregunta' => $request->get('pregunta'),
            'respuesta' => $request->get('respuesta'),
            'etiqueta_1' => $request->get('etiqueta_1'),
            'etiqueta_2' => $request->get('etiqueta_2'),
                //'pregunta' => $request->get('pregunta'),
                //'respuesta' => $request->get('respuesta')
            //'serpro_id' => $request->get('serpro_id'),
        ));

        $question->save();

        return redirect()->back();
    }
}
