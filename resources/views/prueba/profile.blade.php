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
        <form action="" method="post">

            <button type="submit">Enviar</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/product/index.js') }}"></script>
@endsection
