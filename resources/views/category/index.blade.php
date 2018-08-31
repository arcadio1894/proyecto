@extends('layouts.app')

@section('categories', 'open')

@section('category-list', 'active')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Categorias</a>
            </li>

            <li>
                <a href="#">Listado de categorias</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="page-header">
        <h1>
            Lista de Categorias
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Categorias listadas
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id="alerts"></div>
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{!! $category->description !!}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url('/category/edit/'.$category->id) }}">Editar</a>
                                <a class="btn btn-danger" data-delete data-id="{{ $category->id }}" data-name="{{ $category->name }}">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
              </table>
        </div>
    </div>
<div id="modal-delete" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-delete" action="{{ url('/category/delete') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">

                    <div class="form-group">
                        <label for="nombre">¿Está seguro de eliminar esta categoría?</label>
                        <input type="text" id="nombre" value="" class="form-control" name="nombre" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/category/index.js') }}"></script>
@endsection
