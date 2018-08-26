@extends('layouts.app')

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
            Lista de Productos
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Productos listados
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a class="btn btn-primary" href="{{ url('/product/create') }}">Nuevo producto</a>
            <div class="space-6"></div>
            <div id="alerts"></div>
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Moneda</th>
                            <th>Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{!! $product->description !!}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->money }}</td>
                            <td>{{ $product->color }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url('/product/edit/'.$product->id) }}">Editar</a>
                                <a class="btn btn-danger" data-delete data-id="{{ $product->id }}" data-name="{{ $product->name }}">Eliminar</a>
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
                <h5 class="modal-title">Eliminar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-delete" action="{{ url('/product/delete') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">

                    <div class="form-group">
                        <label for="nombre">¿Está seguro de eliminar este producto?</label>
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
    <script type="text/javascript" src="{{ asset('js/product/index.js') }}"></script>
@endsection
