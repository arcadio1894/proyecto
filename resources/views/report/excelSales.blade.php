<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
</head>
<body>
    <div>
    <div>
        <h2>Reporte de ventas entre las fechas {{ $fechaI }} y {{ $fechaF }}</h2>
        @if(count($sales) == 0)
            <h2>No hay datos</h2>
        @else
            @foreach( $sales as $sale)
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Tipo documento</th>
                        <th>Fecha</th>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->state }}</td>
                        @if($sale->type_doc == 'F')
                            <td>FACTURA</td>
                        @else
                            <td>BOLETA</td>
                        @endif
                        <td>{{ $sale->sale_date }}</td>

                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>


                    @foreach($sale->details as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->price_unit }}</td>
                            <td>{{ $detail->quantity }}</td>
                        </tr>
                    @endforeach
                <p>------------------------------------------------</p>
            @endforeach
        @endif

    </div>
</div>
</body>
</html>

