@extends('layouts.app')

@section('categories', 'open')

@section('category-create', 'active')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Categorias</a>
            </li>

            <li>
                <a href="#">Crear categorias</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="page-header">
        <h1>
            Mantenedor de categorias
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Crear categorias
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="alerts"></div>
            <form id="form-create" action="{{ url('/category/store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control" name="nombre" >
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Guardar datos</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <a class="btn btn-warning" href="{{ url('/categories') }}">Ver listado</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/category/create.js') }}"></script>
@endsection
