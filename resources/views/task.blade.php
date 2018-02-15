@extends('layouts.app')

@section('title')
    Task
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Tasks</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/editarTask" method="put" accept-charset="utf-8">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="codTask" value="{{ $task->id }}">
                            <div class="container-fluid">
                                <span>
                                    Nome da Tarefa:
                                </span>
                                <input type="text" name="nomeTarefa" value="{{ $task->nome }}" placeholder="" style="width: 100%;">    
                            </div>
                            <div class="container-fluid">
                                <span style="width: 10%">
                                    Descrição: 
                                </span>
                                <br>
                                <textarea name="descricao" style="width: 100%; border: 1px solid #ccc;">{{ $task->descricao }}</textarea>    
                            </div>
                        </form>
                        <div class="container-fluid">
                            <table id="myTable" class="table table-striped" style="border: 1px solid #ddd;">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th scope="col">Miniatura</th>
                                        <th scope="col">Nome Arquivo</th>
                                        <th scope="col" width="30%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($arquivo as $item)
                                        <tr>
                                            <td scope="col"> 
                                                <div class="col" style="/*overflow: hidden; */height: 100px;width: 120px; border: 1px solid rgb(221, 221, 221); ">
                                                    <a href="{{Storage::url($item->hash)}}" target="_blanck" title="">
                                                        <img src="{{Storage::url($item->hash)}}" alt="" style="width: 100%; max-height: 100%;">
                                                    </a>
                                                </div>
                                            </td>
                                            <td scope="col" style="vertical-align: middle;"> {{ $item->originalName }} </td>
                                            <td width="30%" style="vertical-align: middle;">
                                                <div class="col">
                                                    <form action="/deletaArquivo" method="post" accept-charset="utf-8" style="margin: 2px;">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="codArquivo" value="{{ $item->id }}">
                                                        <input type="hidden" name="codTask" value="{{ $task->id }}">
                                                        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                        <button type="submit" class="btn btn-danger" style="width: 100%;">
                                                            <span class="glyphicon glyphicon-trash"></span> Excluir
                                                        </button>    
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty 
                                            <tr>
                                                <td scope="col">Não existem documentos vinculados a está task.</td>
                                                <td scope="col"></td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div style="margin: 10px 0 5px;float:right;">
                            <a href="/tasks" title="Cancelar">
                                <button type="button" id="cancela" class="btn btn-danger" >Cancelar</button>
                                </a>
                            <button type="submit" class="btn btn-success" >Salvar</button>    
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script type="text/javascript">
        $(document).ready(function(){
            $("#cancela").click(function(){
                window.history.back();
            });
        });
    </script> --}}
@endsection
