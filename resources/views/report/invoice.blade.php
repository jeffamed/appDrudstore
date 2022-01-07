<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
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
        <div style="border-left: 1px dashed black; height: 100vh; position: fixed; margin-left: 49%"></div>
        <table class="tabla">
            <tr>
                <td width="50%">
                    <div>
                        <div class="encabezado">
                            <div class="titulo">
                                <h3>FARMAREDS</h3>
                            </div>
                            <div>
                                <div class="box" style="float: left; width: 50%; padding: 3px">
                                <p><span>R.U.C.:</span>1709318115001</p>
                                <p><span>Dirección:</span>Cdla Maldonado Toledo Calle Gatazo s/n y Saquisili</p>
                                <p><span>Telefono:</span> (03) 2660 486 - Latacunga Ecuador</p>
                            </div>
                                <div class="box" style="float: right; width: 45%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tr>
                                            <td class="center">Factura No.:</td>
                                            <td class="center"><h3><b>{{$sale->id}}</b></h3></td>
                                        </tr>
                                        <tr>
                                            <td class="center">Fecha: </td>
                                            <td class="center"><h3>{{$sale->created}}</h3></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="box" style="width: 99%; border: 1px solid; ">
                                <table width="100%">
                                    <tr rowspan="2">
                                        <td colspan="2">
                                            <p>Cliente: <b>{{$customer->name}} {{$customer->last_name}}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="70%"><p>R.U.C o C.I: {{$customer->document}}</p></td>
                                        <td><p>Telf.:{{$customer->phone}}</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p>Dirección: <span>{{ $customer->address }}</span></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div>
                            <table class="tabla">
                                <thead>
                                <tr>
                                    <th>Cant</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </tr>
                                </thead>
                                <tbody style="border-bottom: 1px solid">
                                    @foreach($details as $detail)
                                    <tr>
                                            <td style="font-size: 11px" class="center">{{$detail->orderQty}}</td>
                                            <td style="font-size: 11px; width: 51%">{{$detail->product->name}}</td>
                                            <td style="font-size: 11px" class="center">{{number_format($detail->unitPrice, 2)}}</td>
                                            <td style="font-size: 11px" class="center">{{number_format($detail->total, 2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td rowspan="3"> <b>ORIGINAL</b> </td>
                                        <td colspan="2" style="text-align: right; padding-right: 25px; border-bottom: 0px">SubTotal</td>
                                        <td class="center" style="font-size: 11px; border-bottom: 0px">{{$sale->subtotal_format}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right; padding-right: 25px; border-bottom: 0px">Descuento</td>
                                        <td class="center" style="font-size: 11px; border-bottom: 0px">{{$sale->discount_format}}</td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td colspan="2" style="text-align: right; padding-right: 25px; border-bottom: 0px">TOTAL</td>
                                        <td class="center" style="font-size: 12px; border-bottom: 0px">{{$sale->total_format}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div>
                        <div class="encabezado">
                            <div class="titulo">
                                <h3>FARMARED</h3>
                            </div>
                            <div>
                                <div class="box" style="float: left; width: 50%; padding: 3px">
                                    <p><span>R.U.C.:</span>1709318115001</p>
                                    <p><span>Dirección:</span>Cdla Maldonado Toledo Calle Gatazo s/n y Saquisili</p>
                                    <p><span>Telefono:</span> (03) 2660 486 - Latacunga Ecuador</p>
                                </div>
                                <div class="box" style="float: right; width: 45%">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tr>
                                            <td class="center">Factura No.</td>
                                        </tr>
                                        <tr>
                                            <td class="center"><h3><b>{{$sale->id}}</b></h3></td>
                                        </tr>
                                        <tr>
                                            <td class="center">Fecha</td>
                                        </tr>
                                        <tr>
                                            <td class="center"><h3>{{$sale->created}}</h3></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="box" style="width: 100%; border: 1px solid">
                                <table width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <p>Cliente: <b>{{$customer->name}} {{$customer->last_name}}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="70%"><p>R.U.C o C.I: {{$customer->document}}</p></td>
                                        <td><p>Telf.:{{$customer->phone}}</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p>Dirección: <span>{{ $customer->address }}</span></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div>
                            <table class="tabla" >
                                <thead>
                                <tr style="padding-bottom: 5px">
                                    <th>Cant</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </tr>
                                </thead>
                                <tbody style="border-bottom: 1px solid">
                                    @foreach($details as $detail)
                                    <tr>
                                            <td style="font-size: 11px" class="center">{{$detail->orderQty}}</td>
                                            <td style="font-size: 11px; width: 51%">{{$detail->product->name}}</td>
                                            <td style="font-size: 11px" class="center">{{number_format($detail->unitPrice, 2)}}</td>
                                            <td style="font-size: 11px" class="center">{{number_format($detail->total, 2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td rowspan="3"> <b>COPIA</b> </td>
                                        <td colspan="2" style="text-align: right; padding-right: 25px; border-bottom: 0px">SubTotal</td>
                                        <td class="center" style="font-size: 11px; border-bottom: 0px">{{$sale->subtotal_format}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right; padding-right: 25px; border-bottom: 0px">Descuento</td>
                                        <td class="center" style="font-size: 11px; border-bottom: 0px">{{$sale->discount_format}}</td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td colspan="2" style="text-align: right; padding-right: 25px; border-bottom: 0px">TOTAL</td>
                                        <td class="center" style="font-size: 12px; border-bottom: 0px">{{$sale->total_format}}</td>
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
