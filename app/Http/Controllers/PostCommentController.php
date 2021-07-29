<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\use_occ;
use App\Models\Post_comment;
use App\Models\Question;
use App\Models\Answer;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function newComment(Request $request){

        $validation = $request->validate([
            'comentario'=>'required|string|max:400',
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
                    return ("No se pudo procesar");
                    break;
            }

        $comment->save();

        return redirect()->back();

        
    }

    public function newQuestion(Request $request){

        $request->validate([
            'pregunta'=>'required|string|min:10|max:170',
            'respuesta'=>'required|string|min:10|max:350',
        ]);
        
        switch ($request->typeJobFromQuestion){
            case 1:
                $question = new Question(array(
                    'pregunta' => $request->get('pregunta'),
                    'respuesta' => $request->get('respuesta'),
                    // 'use_id' => auth()->user()->id,
                    'use_occ_id' => $request->get('serviceId'),
                ));
        
                break;
            case 2:
                $question = new Question(array(
                    'pregunta' => $request->get('pregunta'),
                    'respuesta' => $request->get('respuesta'),
                    // 'use_id' => auth()->user()->id,
                    'use_tal_id' => $request->get('serviceId'),
                ));

                break;
            default :
                return ("No se pudo procesar");
                break;
        }

        $question->save();

        return redirect()->back();
    }

    public function newAnswer(Request $request){

        $request->validate([
            'comentarioRespuesta'=>'required|string|max:400',
        ]);
    
            $answer = new Answer(array(
                'comentario' => $request->get('comentarioRespuesta'),
                'use_id' => auth()->user()->id,
                'use_com_id' => $request->get('ComId'),
            ));
            
        $answer->save();

        return redirect()->back();
    }
}
