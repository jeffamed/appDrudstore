<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe</title>
    <style>
        *{
            margin: 5px;
            padding: 0;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 20vh;
        }
        body{
            margin: 0;
            margin-left: 10px;
            font-size: 15px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-image: url("./img/logoweb.png");
            background-repeat: no-repeat;
            background-position: top right;
            background-size: 270px;
        }
        h5{
            font-weight: normal;
            font-family: Arial;
        }
        .bold{
            font-weight: bold
        }
        .tabla{
            width: 99%;
            border-spacing: 0;
            padding: 0;
            margin: 0;
        }
        th,td{
            text-align: left;
            border-spacing: 0;
            border-collapse: collapse;
        }
        tbody{
            border-bottom: 0px solid;
        }
        th{
            border-top: 0px solid;
            border-bottom: 0px solid;
            text-align: center;
        }
        tfoot tr td{
            padding-top: 10px;
        }
         #sales {
             font-family: Arial, Helvetica, sans-serif;
             border-collapse: collapse;
             width: 100%;
         }

        #sales td, #sales th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #sales tr:nth-child(even){background-color: #f2f2f2;}

        #sales tr:hover {background-color: #ddd;}

        #sales th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #0082CA;
            color: white;
        }
    </style>
</head>
<body>
<div  style="margin-bottom: 30px">
    <div style="text-align: center">
        <h2 class="bold text-center">FARMACIA FARMAREDS</h2>
    </div>
    <div style="margin-bottom: 40px; border: 1px solid; padding: 5px">
        <table width="100%">
            <tr>
                <td style="width: 80%">
                    <h4>Reporte de Ventas</h4>
                </td>
                <td>
                    <h4 style="text-align: right">{{ now()->format('d/m/Y') }}</h4>
                </td>
            </tr>
        </table>
    </div>
</div>
<table class="tabla" id="sales">
    <thead>
    <tr>
        <th style="text-align: left">Mes</th>
        <th style="text-align: center">SubTotal</th>
        <th style="text-align: center">Descuento</th>
        <th style="text-align: center">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($sales as $sale)
        <tr style="padding-bottom: 10px; padding-top: 10px">
            <td>{{ $sale->mes }}</td>
            <td style="text-align: center">{{ number_format($sale->subTotal , 2) }}</td>
            <td style="text-align: center">{{ number_format($sale->Descuento, 2) }}</td>
            <td style="text-align: center">{{ number_format($sale->Total, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr class="bold">
            <td>Total</td>
            <td style="text-align: center">
                {{number_format( $sales_total[0]->subTotal, 2) }}
            </td>
            <td style="text-align: center">
                {{number_format( $sales_total[0]->Descuento, 2) }}
            </td>
            <td style="text-align: center">
                {{number_format( $sales_total[0]->Total, 2) }}
            </td>
        </tr>
    </tfoot>
</table>
</body>
</html>
