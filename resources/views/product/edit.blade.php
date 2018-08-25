@extends('layouts.app')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Productos</a>
            </li>

            <li>
                <a href="#">Editar productos</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div id="alerts"></div>
            <form id="form-edit" action="{{ url('/product/update') }}">
                {{ csrf_field() }}
                <legend>Editar producto</legend>
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" value="{{ $product->name }}" class="form-control" name="nombre" >
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="3" name="descripcion"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" value="{{ $product->price }}" class="form-control" name="precio" >
                </div>
                <div class="form-group">
                    <label for="moneda">Moneda</label>
                    <input type="text" id="moneda" value="{{ $product->money }}" class="form-control" name="moneda" >
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" id="color" value="{{ $product->color }}" class="form-control" name="color" >
                </div>
                @if($product->state == 1)
                    <div class="form-group">
                        <label for="color">Estado</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="state" id="state1" value="1" checked>
                            <label class="form-check-label" for="state1">
                                En buenas condiciones
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="state" id="state2" value="0">
                            <label class="form-check-label" for="state2">
                                Estado obsoleto
                            </label>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label for="color">Estado</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="state" id="state1" value="1" >
                            <label class="form-check-label" for="state1">
                                En buenas condiciones
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="state" id="state2" value="0" checked>
                            <label class="form-check-label" for="state2">
                                Estado obsoleto
                            </label>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" id="comentario" rows="3" name="comentario"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar datos</button>
                <a class="btn btn-warning" href="{{ url('/products') }}">Ver listado</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/product/edit.js') }}"></script>
@endsection
