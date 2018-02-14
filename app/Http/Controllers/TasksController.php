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
        
        $task = Task::find($request->codTask);
        $arquivo = Arquivo::where('id_task', '=', $request->codTask)->get();
        // $dados->task = $task;
        // $dados->arquivo = $arquivo;
        return view('task', compact('task','arquivo'));
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

        $id_task = $dados->id;
        $dados = $request->file();

        foreach ($request->file() as $item) {   
            $path  = $item->store('public');
            $arquivo = new Arquivo();
            $arquivo->hash          = $item->hashName();
            $arquivo->originalName  = $item->getClientOriginalName();
            $arquivo->local         = 'public';
            $arquivo->mimeType      = $item->getMimeType();
            $arquivo->size          = $item->getSize();
            $arquivo->id_task       = $id_task;
            $arquivo->save();
        }

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
