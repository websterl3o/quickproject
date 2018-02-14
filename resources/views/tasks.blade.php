@extends('layouts.app')

@section('title')
    Tasks
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css">
    <style type="text/css" media="screen">
        form .btn{
            font-size: 12px;
        }
        .glyphicon {
            font-size: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 55px">
                        <div style="float: left; padding: 8px; font-size: 15px;">
                            Tasks
                        </div>
                        <div style="float: right;">
                            <button type="button" class="btn btn-primary" id="adicionarNovo">
                                <span class="glyphicon glyphicon-plus"></span> Adicionar novo
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success"> 
                                {{ session('status') }}
                            </div>
                        @endif

    
                        {{-- @php
                            echo "<pre>";
                            print_r($tasks);
                            echo "</pre>";
                        @endphp --}}

                        <table id="myTable" class="table table-striped" style="border: 1px solid #ddd;">
                            <thead>
                                <tr>
                                    <th scope="col" width="20%">Nome</th>
                                    <th scope="col" width="30%">Descrição</th>
                                    <th scope="col" width="30%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                <tr scope="row">
                                    <td>{{ $task->nome }}</td>
                                    <td>{{ $task->descricao }}</td>
                                    <td class="coluna_de_botoes">
                                        @if($task->status == 1)
                                            <div class="col">
                                                <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                <button type="button" class="btn btn-info" disabled style="width: 100%;">
                                                    <span class="glyphicon glyphicon-check"></span> Concluído
                                                </button>    
                                            </div>
                                        @else
                                        <div class="col">
                                            <form action="/marcarconclusao" method="post" accept-charset="utf-8" style="margin: 2px;position: relative;float: left;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- Indicates a successful or positive action -->
                                                <button type="submit" style="width: 100%;" class="btn btn-success" id="concluiTarefa">
                                                    <span class="glyphicon glyphicon-ok"></span> Concluir
                                                </button>
                                                <input type="hidden" name="codTask" value="{{ $task->id }}">
                                            </form>
                                        </div>
                                        <div class="col">
                                            <a href="/task?codTask={{ $task->id }}" title="" style="margin: 2px;position: relative;float: left;">
                                                <button type="submit" style="width: 100%;" class="btn btn-warning" id="concluiTarefa">
                                                    <span class="glyphicon glyphicon-edit"></span> Editar
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <form action="/deletaTask" method="post" accept-charset="utf-8" style="margin: 2px;position: relative;float: left;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
                                                <button type="submit" style="width: 100%;" class="btn btn-danger" id="deletaTarefa">
                                                    <span class="glyphicon glyphicon-trash"></span> Excluir
                                                </button>
                                                <input type="hidden" name="codTask" value="{{ $task->id }}">
                                            </form>
                                        </div>
                                        @endif   
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myTable').DataTable({
                oLanguage: {
                    "sEmptyTable":      "Não existem tarefas cadastradas",
                    "sInfo":            "De _START_ á _END_ itens de um total de _TOTAL_",
                    "sInfoEmpty":       "0 á 0 de 0 itens",
                    "sInfoFiltered":    "(Filtro de _MAX_ itens)",
                    "sInfoPostFix":     "",
                    "sInfoThousands":   ".",
                    "sLengthMenu":      "Mostrar: _MENU_ ",
                    "sLoadingRecords":  "Carregando...",
                    "sProcessing":      "Aguarde...",
                    "sSearch":          "Pesquisar",
                    "sZeroRecords":     "Não foram encontrados informações referentes a busca.",
                    "oPaginate": {
                        "sFirst":       "Primeira",
                        "sPrevious":    "Anterior",
                        "sNext":        "Próxima",
                        "sLast":        "Última"
                    }
                }
                //,
                //"order": [[ 0, 'desc' ]]
            });
            $("#adicionarNovo").click(function(){
                window.location.href="/newtask";
            });  
        });
    </script>
@endsection