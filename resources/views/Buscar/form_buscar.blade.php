@extends('adminlte::page')
@section('title', 'Buscar')
@section('content_header')
    <h1>Incio</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <x-adminlte-select name="selEstado" igroup-size="lg">
                                    <option value="" selected disabled>--Selecciona Estado</option>
                                    @foreach($estados as $estado)
                                        <option value="{{$estado->c_estado}}">{{$estado->d_estado}}</option>
                                        <option >Option 3</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <x-adminlte-select name="selMunicipio" igroup-size="lg">
                                    <option value="" selected disabled>--Selecciona Municipio</option>
                                    <option>Option 2</option>
                                    <option >Option 3</option>
                                </x-adminlte-select>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <x-adminlte-input name="order" placeholder="Escribe una cantidad"
                                igroup-size="lg" disable-feedback/>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success ">
                            Buscar
                        </button>                    
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" >
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabladatos">
                            <thead>
                                <th>CODIGO</th>
                                <th>d_asenta</th>
                                <th>d_tipo_asenta</th>
                                <th>D_mnpio</th>
                                <th>d_estado</th>
                                <th>d_ciudad</th>
                                <th>d_CP</th>
                                <th>c_estado</th>
                                <th>c_CP</th>
                                <th>c_tipo_asenta</th>
                                <th>c_mnpio</th>
                                <th>id_asenta_cpcons</th>
                                <th>d_zona</th>
                                <th>c_cve_ciudad</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>
@stop
@section('css')
 
@stop

@section('js')
    <script> 
        $(function () {
            $("#tabladatos").DataTable({
                // "order": [[ 2, "asc" ]],
                columnDefs: [
                    {
                        // visible: false, 
                        // targets: [0,4,6]
                    }
                ],
                "responsive": false, "lengthChange": true, "autoWidth": false,"ordering": true,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "buttons":{
                        "colvis":"Columna visible"
                    }
                },
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop