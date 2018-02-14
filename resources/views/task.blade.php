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
                            <div class="container-fluid">
                                <table id="myTable" class="table table-striped" style="border: 1px solid #ddd;">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>Nome Arquivo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($arquivo as $item)
                                            <tr>
                                                <td>{{ $item->originalName }}</td>
                                                <td>
                                                    <div class="col">
                                                        <form action="/deletaTask" method="post" accept-charset="utf-8" style="margin: 2px;position: relative;float: left;">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="codTask" value="{{ $task->id }}">
                                                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                            <button type="button" class="btn btn-danger" style="width: 100%;">
                                                                <span class="glyphicon glyphicon-trash"></span> Excluir
                                                            </button>    
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty ($item)
                                                <tr>
                                                    <td>Não existem documentos vinculados a está task.</td>
                                                    <td></td>
                                                </tr>
                                            @endempty
                                        @endforelse
                                        <?php
                                            echo $arquivo;
                                        ?>
                                        
                                    </tbody>
                                </table>
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
