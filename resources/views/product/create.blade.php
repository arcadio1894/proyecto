@extends('layouts.app')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Productos</a>
            </li>

            <li>
                <a href="#">Crear productos</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="alerts"></div>
            <form id="form-create" action="{{ url('/product/store') }}">
                {{ csrf_field() }}
                <legend>Nuevo producto</legend>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control" name="nombre" >
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" class="form-control" name="descripcion" >
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" class="form-control" name="precio" >
                </div>
                <div class="form-group">
                    <label for="moneda">Moneda</label>
                    <input type="text" id="moneda" class="form-control" name="moneda" >
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" id="color" class="form-control" name="color" >
                </div>
                <button type="submit" class="btn btn-primary">Guardar datos</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <a class="btn btn-warning" href="{{ url('/products') }}">Ver listado</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/product/create.js') }}"></script>
@endsection
