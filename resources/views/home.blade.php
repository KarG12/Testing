@extends('adminlte::page')
@section('title', 'Bienvenido')
@section('content_header')
    <h1>Incio</h1>
@stop
@section('content')
<div class="container-fluid">

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">{{ __('Prueba de Conocimientos') }}</div>
                <div class="card-body" style="height: 1000px;">
                    <embed src="{{URL::asset('document/Ejercicios_PHP.pdf')}}#zoom=100" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop