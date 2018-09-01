@extends('layouts.app')

@section('opcionUser', 'open')

@section('perfil', 'active')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Compras</a>
            </li>

            <li>
                <a href="#">Listado de compras</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="page-header">
        <h1>
            Perfil
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Datos
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <form id="form-date" action="{{ url('/profile') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="fecha">Fecha Nacimiento</label>
                <input type="date" id="fecha" class="form-control" name="fecha" >
            </div>
            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>

@endsection

@section('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/prueba/profile.js') }}"></script>--}}
@endsection
