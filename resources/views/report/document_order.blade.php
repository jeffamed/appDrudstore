<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compra</title>
    <style>
        *{
            margin: 3px;
            padding: 0px;
        }
        body{
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .contenido{
            width: 100%;
        }
        .titulo{
            font-size: 16px;
            margin-bottom: 5px;
            text-align: center;
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
        td:nth-child(2){
            padding-bottom: 2px;
        }
        th{
            border-top: 1px solid;
            border-bottom: 1px solid;
            text-align: center;
        }
        tfoot tr td{
            padding-top: 5px;
        }
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="contenido">
    <table class="tabla">
        <tr>
            <td>
                <div>
                    <div class="encabezado">
                        <div class="titulo">
                            <h3>FARMARED'S</h3>
                        </div>
                        <div style="border: 1px solid">
                            <table width="100%">
                                <tr>
                                    <td width="70%">
                                        <p><span>R.U.C.:</span>1709318115001</p>
                                        <p><span>Dirección:</span>Cdla Maldonado Toledo Calle Gatazo s/n y Saquisili</p>
                                        <p><span>Telefono:</span> (03) 2660 486 - Latacunga Ecuador</p>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Compra No.:</td>
                                                <td class="center"><h3><b>{{$order->num_order}}</b></h3></td>
                                            </tr>
                                            <tr>
                                                <td>Fecha:</td>
                                                <td class="center"><h3>{{$order->created}}</h3></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <div style="width: 99%;">
                                <table width="100%">
                                    <tr rowspan="2">
                                        <td colspan="2">
                                            <p>Proveedor: <b>{{$supplier->name}}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="70%"><p>R.U.C: {{$supplier->ruc}}</p></td>
                                        <td><p>Telf.:{{$supplier->phone}}</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p>Dirección: <span>{{ $supplier->address }}</span></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <table class="tabla">
                            <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio $</th>
                                <th>Descuento %</th>
                                <th>SubTotal $</th>
                            </tr>
                            </thead>
                            <tbody style="border-bottom: 1px solid">
                            @foreach($details as $detail)
                                <tr>
                                    <td style="font-size: 11px" class="center">{{$detail->orderQty}}</td>
                                    <td style="font-size: 11px;">{{$detail->product->name}}</td>
                                    <td style="font-size: 11px" class="center">{{number_format($detail->unitPrice, 2)}}</td>
                                    <td style="font-size: 11px" class="center">{{ $detail->discount }}</td>
                                    <td style="font-size: 11px" class="center">{{number_format($detail->total, 2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: right; padding-right: 25px; border-bottom: 0px">SubTotal</td>
                                <td class="center" style="font-size: 11px; border-bottom: 0px">$ {{$order->subtotal_format}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right; padding-right: 25px; border-bottom: 0px">IVA</td>
                                <td class="center" style="font-size: 11px; border-bottom: 0px">$ {{$order->iva}}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td colspan="4" style="text-align: right; padding-right: 25px; border-bottom: 0px">TOTAL</td>
                                <td class="center" style="font-size: 12px; border-bottom: 0px">$ {{$order->total_format}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
