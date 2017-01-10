<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Scene;

class sceneController extends Controller
{
    public function lista(){
        $scenes = Scene::all();
        return view('scene.listagem')->with('scenes', $scenes);
    }

    public function novo(Request $request){
        $scene = new Scene();
        return view('scene.formulario')->with('scene', $scene);
    }

    public function adiciona(Request $request){
        $id = $request->input('id', 0);
        Scene::updateOrCreate(['id'=> $id], $request->all());

        return redirect()
            ->action('sceneController@lista');
    }

    public function edita(Scene $scene){
        if(empty($scene)) {
            return "Essa cena não existe";
        }
        return view('scene.formulario')->with('scene', $scene);
    }

    public function remove(Scene $scene){
        $scene->delete();
        return redirect()->action('sceneController@lista');
    }
}
