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
        
        switch ($request->typeJobFromComment){
            case 1:
                $comment = new Post_comment(array(
                    'comentario' => $request->get('comentario'),
                    'use_id' => auth()->user()->id,
                    'use_occ_id' => $request->get('serviceId'),
                ));
        
                break;
            case 2:
                $comment = new Post_comment(array(
                    'comentario' => $request->get('comentario'),
                    'use_id' => auth()->user()->id,
                    'use_tal_id' => $request->get('serviceId'),
                ));

                break;
            default :
                dd("No se pudo procesaro");
                break;
        }

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
