@extends('layouts.app')

@section('opcionUser', 'open')

@section('historial', 'active')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Productos</a>
            </li>

            <li>
                <a href="#">Listado de productos</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="page-header">
        <h1>
            Historial de Compras
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Compras realizadas
            </small>
        </h1>
    </div><!-- /.page-header -->

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/product/index.js') }}"></script>
@endsection
