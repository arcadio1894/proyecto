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
                <a href="#">Editar categorias</a>
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
                Editar categorias
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="alerts"></div>
            <form id="form-edit" action="{{ url('/category/update') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $category->id }}">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" value="{{ $category->name }}" class="form-control" name="nombre" >
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ $category->description }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar datos</button>
                <a class="btn btn-warning" href="{{ url('/categories') }}">Ver listado</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/category/edit.js') }}"></script>
@endsection
