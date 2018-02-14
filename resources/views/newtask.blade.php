@extends('layouts.app')

@section('title')
    New Tasks
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Tasks</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/savetask" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="container-fluid">
                                <span>
                                    Nome da Tarefa:
                                </span>
                                <input type="text" name="nomeTarefa" value="" placeholder="" style="width: 100%;">    
                            </div>
                            <div class="container-fluid">
                                <span>
                                    Descrição: 
                                </span>
                                <br>
                                <textarea name="descricao" style="width: 100%; border: 1px solid #ccc;"></textarea>    
                            </div>

                            <div class="container-fluid">
                                <input type="file" name="aqruivo1" value="" placeholder="">
                            </div>
                            <div class="container-fluid">
                                <input type="file" name="arquivo2" value="" placeholder="">
                            </div>
                            <div class="container-fluid">
                                <input type="file" name="arquivo3" value="" placeholder="">
                            </div>
                            <div class="container-fluid">
                                <input type="file" name="arquivo4" value="" placeholder="">
                            </div>

                            <div style="margin: 10px 0 5px">
                                <button type="submit" class="btn btn-success" style="float: right;">Salvar</button>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
