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
        <h2>Reporte de ventas entre las fechas {{ $fechaI }} y {{ $fechaF }}</h2>
        @if(count($sales) == 0)
            <h2>No hay datos</h2>
        @else
            @foreach( $sales as $sale)
                <table>
                    <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Tipo documento</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->state }}</td>
                        @if($sale->type_doc == 'F')
                            <td>FACTURA</td>
                        @else
                            <td>BOLETA</td>
                        @endif
                        <td>{{ $sale->sale_date }}</td>
                    </tr>
                    </tbody>

                </table>
                <table>
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sale->details as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->price_unit }}</td>
                            <td>{{ $detail->quantity }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <p>------------------------------------------------</p>
            @endforeach
        @endif

    </div>
</div>
</body>
</html>

