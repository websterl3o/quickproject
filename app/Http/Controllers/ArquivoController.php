<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Arquivo;
use App\Task;

class ArquivoController extends Controller
{
    /**
     * Deleta Arquivo
    */
    public function deletaArquivo(Request $request){
        
        $arquivo = Arquivo::find($request->codArquivo);
        // $newrequest->codTask = $request->codTask;
        Storage::delete($arquivo->hash);
        $arquivo->delete();
        return back();
    }
}
