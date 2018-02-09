<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Task;
use App\Arquivo;
// use App\Http\Request;


class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista todas as Task do Banco
    */
    public function listTasks(){
        // $tasks = \Tasks::paginate(10);
        // $tasks = new Tasks;
        $tasks = Task::all();
        // return view('user.index', ['users' => $users]);
        return view('tasks', compact('tasks'));
    }

    /**
     * Lista todas as Task do Banco
    */
    public function vertask(Request $request){
        // $tasks = \Tasks::paginate(10);
        // $tasks = new Tasks;
        $task = Task::find($request->codTask);
        // dd($task);
        // return view('user.index', ['users' => $users]);
        return view('task', compact('task'));
    }

    /**
	 * Salva Task no Banco
	*/
    public function salvaTask(Request $request){
        
        $dados = new Task();
        $dados->nome = $request->nomeTarefa;
        $dados->descricao = $request->descricao;
        $dados->status = 0;
        $dados->save();
        $path = $request->file('arquivo1')->store('local');
        /*
        $_FILE = $request->file();
        foreach ($_FILE as $item) {
            $arquivo = new Arquivo();
            $var = 0;
            whille($var = 1){
                $return = md5(date("Y-m-d H:i:s"));
                $arquivo = Arquivo::where('hash', '=', $return)->first();
                if($arquivo){
                    $var = 0;
                }
                else{
                    $var = 1;
                }
            }
            $arquivo->hash          = $return;
            $arquivo->originalName  = $item['name'];
            $arquivo->local         = './';
            $arquivo->mimeType      = $item['type'];
            $arquivo->size          = $item['size'];
            $arquivo->id_task       = $item['id_task'];

        }
        $arquivo->save();
        die();
        */
        die();
        return redirect ("/tasks");
    }

    /**
     * Atera status da Task no Banco
    */
    public function marcarConclusao(Request $request){
        
        $task = Task::find($request->codTask);
        $task->status = 1;
        $task->save();
        
        return redirect ("/tasks");
    }

    /**
     * Atera Task no Banco
    */
    public function editarTask(Request $request){
        // echo $request;die();
        $task = Task::find($request->codTask);
        $task->nome = $request->nomeTarefa;
        $task->descricao = $request->descricao;
        $task->save();
        
        return redirect ("/tasks");
    }

    /**
     * Deleta Task no Banco   Clement
    */
    public function deletaTask(Request $request){
        
        $task = Task::find($request->codTask);
        $task->delete();
        
        return redirect ("/tasks");
    }

}
