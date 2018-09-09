<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h2>Reporte de productos</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Moneda</th>
                <th>Stock</th>
                <th>Color</th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{!! $product->description !!}</td>
                    @if (!isset($product->category))
                        <td>Sin categoría</td>
                    @else
                        <td>{{ $product->category->name }}</td>
                    @endif
                    @if (!isset($product->brand))
                        <td>Sin marca</td>
                    @else
                        <td>{{ $product->brand->name }}</td>
                    @endif
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->money }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->color }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
</body>
</html>

