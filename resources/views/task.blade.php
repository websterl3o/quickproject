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
                        <form action="/editarTask" method="post" accept-charset="utf-8">
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
                            <div style="margin: 10px 0 5px;float:right;">
                                <button type="button" id="cancela" class="btn btn-danger" >Cancelar</button>    
                                <button type="submit" class="btn btn-success" >Salvar</button>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cancela").click(function(){
                window.history.back();
            });
        });
    </script>
@endsection
