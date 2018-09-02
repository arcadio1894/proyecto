@extends('layouts.app')

@section('sale', 'open')

@section('create', 'active')

@section('styles')
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Compras</a>
            </li>

            <li>
                <a href="#">Crear compra</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="page-header">
        <h1>
            Mantenedor de compras
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Crear compras
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="alerts"></div>
            <form id="form-create" action="{{ url('/sale/store') }}">
                {{ csrf_field() }}
                <div class="form-group">

                    <h4><strong>Datos de la compra</strong></h4>

                </div>
                <div class="form-group">
                    <label for="color">Tipo de documento</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_doc" id="state1" value="F" checked>
                        <label class="form-check-label" for="state1">
                            Factura
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_doc" id="state2" value="B">
                        <label class="form-check-label" for="state2">
                            Boleta
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha de compra</label>
                    <input type="date" id="fecha" name="fecha" class="form-control">
                </div>
                <div class="form-group">
                    <label for="comentario">Comentario de compra</label>
                    <textarea id="comentario" name="comentario" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">

                    <h4><strong>Agregar productos a la lista</strong></h4>

                </div>


                <div class="form-group">
                    <label for="productos">Productos</label>
                    <input type="hidden" id="url-price" data-url="{{ url('/getPriceById') }}">
                    <input type="hidden" id="url-quantity" data-url="{{ url('/getQuantityById') }}">
                    <select id="productos" name="productos" class="form-control">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" class="form-control" name="precio" >
                </div>
                <input type="hidden" id="quantity-product">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="text" id="cantidad" class="form-control" name="cantidad" >
                </div>

                <button type="button" id="add-product" class="btn btn-primary">Agregar Producto</button>

                <template id="template-products">
                    <tr>
                        <td data-i></td>
                        <td data-product></td>
                        <td data-price></td>
                        <td data-quantity></td>
                        <td>
                            <button data-delete type="button" class="btn btn-danger">Quitar</button>
                        </td>
                    </tr>
                </template>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="table-products">

                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Guardar datos</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <a class="btn btn-warning" href="{{ url('/sales') }}">Ver listado</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/sale/create.js') }}"></script>
@endsection
