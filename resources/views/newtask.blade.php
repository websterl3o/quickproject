@extends('layouts.app')

@section('title')
    New Tasks
@endsection

@section('style')
    <style type="text/css" media="screen">
        .arquivo {
          display: none !important;
        }
        .file {
          line-height: 30px;
          height: 30px;
          border: 1px solid #A7A7A7;
          padding: 5px;
          box-sizing: border-box;
          font-size: 15px;
          vertical-align: middle;
        }
    </style>
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

                            <div class="container-fluid" id="area_de_inputs_Files">
                                <span>
                                    Upload de aquivos: 
                                </span>
                                <br>
                                <table class="table">
                                    <tbody id="listaArqs">
                                        <tr scope="row">
                                            <td style="display: none">
                                                <input type="file" name="arquivo" id="arquivo" referencia="file" class="arquivo">
                                            </td>
                                            <td colspan="">
                                                <input type="text" name="file" id="file" class="file span8" placeholder="Arquivo" readonly="readonly" style="width: 100%; height: 36px;">
                                            </td>
                                            <td colspan="">
                                                <button type="button" class="btn btn-primary span3" referencia="arquivo" style="width: 100%"> SELECIONAR </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="container-fluid">
                                    <button type="button" class="btn btn-warning span1" id="Adiciona" style="width: 100%"><span class="glyphicon glyphicon-plus"></span> Adicionar novo arquivo </button>
                                </div>
                                <input type="hidden" name="contador_campos" id="contador_campos" value="0">
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

@section('scripts')
    <script type="text/javascript">
        $(document).on('click', "button.span3" ,function(){
            console.log(`passo`);
            alert($(this).attr('referencia'));
            var seleciona = $(this).attr('referencia');
            $('input[name="'+seleciona+'"]').trigger('click');
        });

        $(document).on('change','.arquivo', function() {
            // alert($(this).attr('referencia'));
            console.log("entro");
            var seleciona = $(this).attr('referencia');
            var fileName = $(this)[0].files[0].name;
            $('#'+seleciona).val(fileName);
        });

        $('#Adiciona').on('click', function() {
            // alert($('#contador_campos').val());
            var contador = parseInt($('#contador_campos').val());
            contador = contador+1;
            console.log(contador);
            $('#contador_campos').val(contador);
            // alert(contador);
            $('#listaArqs').append(
                '<tr scope="row"> <td style="display: none"><input type="file" name="arquivo'+contador+'" id="arquivo" referencia="file'+contador+'" class="arquivo"></td><td colspan=""><input type="text" name="file" id="file'+contador+'" class="file span8" placeholder="Arquivo" readonly="readonly" style="width: 100%; height: 36px;"></td><td colspan=""><button type="button" class="btn btn-primary span3" referencia="arquivo'+contador+'" style="width: 100%"> SELECIONAR </button></td></tr>'
                );
        });


    </script>
@endsection
