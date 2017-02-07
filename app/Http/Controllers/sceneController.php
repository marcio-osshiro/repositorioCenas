<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Scene;
use Input;

class sceneController extends Controller
{
    public function lista(){
        $scenes = Scene::orderBy('label')->get();
        return view('scene.listagem')->with('scenes', $scenes);
    }

    public function novo(Request $request){
        $scene = new Scene();
        return view('scene.formulario')->with('scene', $scene);
    }

    public function adiciona(Request $request){
        $id = $request->input('id', 0);
        if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');
            $random_name = str_random(8);
            $destinationPath = 'textures/';
            $extension = $file->getClientOriginalExtension();
            $filename=$random_name.time().'.'.$extension;
            $uploadSuccess = $request->file('arquivo')->move($destinationPath, $filename);
            $request->merge( array( 'map_kd' => $filename ) );
        }   
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