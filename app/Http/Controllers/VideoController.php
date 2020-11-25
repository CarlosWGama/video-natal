<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class VideoController extends Controller {
    //

    /* Acessa a página */
    public function index() {
        return view('video');
    }


    /** Cria o vídeo */
    public function renderizaVideo(Request $request) {

        try {
            $id = 1;
            $uid = uniqid();

            $audio = $request->nome;
            $foto = $_FILES['arquivo']['tmp_name'];

        
            shell_exec('python ' . base_path('script/main.py') . ' ' . $uid . ' ' . $audio . ' ' . $foto);
            //$process->mustRun();
            return response()->json(['sucesso' => true, 'video' => $uid]);

        } catch (Exception $e) {
            return response()->json(['sucesso' => false]);
        }
    }

    /** Baixa o vídeo */
    public function baixar($uid) {
        return Storage::download('videos/video_'.$uid.'.mp4');
    } 
}
