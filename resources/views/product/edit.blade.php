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
    <div class="page-header">
        <h1>
            Mantenedor de productos
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Editar productos
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="alerts"></div>
            <form id="form-edit" action="{{ url('/product/update') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}">
                @if(!isset($product->brand_id))
                    <input type="hidden" id="brand_id" value="0">
                    <input type="hidden" id="category_id" value="0">
                @else
                    <input type="hidden" id="category_id" value="{{ $product->category_id }}">
                    <input type="hidden" id="brand_id" value="{{ $product->brand_id }}">
                @endif

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
                    <label for="stock">Stock</label>
                    <input type="text" id="stock" class="form-control" name="stock" value="{{ $product->stock }}">
                </div>
                <div class="form-group">
                    <label for="categoria">Categorías</label>
                    <select id="categoria" name="categoria" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="marca">Marcas</label>
                    <select id="marca" name="marca" class="form-control">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
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
