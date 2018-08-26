@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/chosen/chosen.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('plugins/trumbowyg/dist/ui/trumbowyg.min.css') }}">
    <style>
        .typeahead { z-index: 1051; }
    </style>
@endsection

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
    <div class="page-header">
        <h1>
            Mantenedor de productos
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Crear productos
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="alerts"></div>
            <form id="form-create" action="{{ url('/product/store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control" name="nombre" >
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="typeahead">Selector de productos(No se guarda)</label>
                    <input type="text" id="typeahead" data-url="{{ url('productos') }}" class="form-control typeahead" data-provide="typeahead">
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
                    <label for="stock">Stock</label>
                    <input type="text" id="stock" class="form-control" name="stock" >
                </div>
                <div class="form-group">
                    <label for="categoria">Categorías</label>
                    <select id="categoria" name="categoria" class="form-control chosen-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="marca">Marcas</label>
                    <select id="marca" name="marca" class="form-control chosen-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
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
    <script src="{{ asset('plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
    <script src="{{ asset('plugins/trumbowyg/dist/trumbowyg.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/product/create.js') }}"></script>
@endsection
