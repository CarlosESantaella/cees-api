<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reception PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 10px;
            line-height: 1.4;
        }
        .table-content {
            margin-bottom: 10px;
            border: 1px solid #606060;
            padding: 5px;
            width: 100%;
        }
        .w-100{
            width: 100%;
        }
        .header td {
            text-align: center;
        }
        .title {
            text-align: center;
        }
        .general_data {
            width: 100%;
            margin: 25px 0;
            font-size: 0.9rem;
        }
        .general_data td {
            width: 50%;
            padding: 0 5px;
        }
        .general_data.images td {
            display: inline-table;
            width: 33.33%;
            text-align: center;
            padding: 0 5px;
        }
        .general_data.images img {
            max-width: 100%;
            width: auto;
            margin: 0 auto;
            max-height: 200px;
        }
        .general_data b {
            display: inline-block;
            min-width: 200px
        }
        .general_data span {
            display: inline-block;
            width: 160px;
            border-bottom: 1px solid #606060;
        }
        .observations-box{
            min-height: 100px;
        }
        .sign_data {
            font-size: 0.9rem;
            width: 100%;
            margin: 20px 0;
        }
        .sign_data td {
            width: 50%;
            padding: 0 5px 0 0;
        }
        .sign_data span {
            display: block;
            margin: 0 auto;
            margin-bottom: -15px;
            border-bottom: 1px solid #606060;
            width: 200px;
        }
        .sign_data p{
            text-align: center;
        }
    </style>
</head>
<body>
    <table class="header w-100" style="margin-bottom: 15px;">
        <thead>
            <tr>
                <td>
                    @if(!$pdf) 
                    <img src="{{asset('vero-internet.png')}}" width="120">
                    @else
                    <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path(str_replace(env('SITE_URL'), "/public", str_replace(['\\', ' '], '', trim($configurations->logo_path)))))); ?>" style="width: 770px; object-fit: cover; object-position: center;">
                    @endif
                    {{-- <h1 style="font-size: 1rem; margin-bottom: 5px">Vero Internet Corporation LTDA</h1>
                    <p style="font-size: 0.9rem">São Sebastião do Caí – RS <br>Rua Coronel Paulino Teixeira, 915, sala 02 – Centro</p> --}}
                </td>
            </tr>
        </thead>
    </table>
    
    <table class="title table-content">
        <thead>
            <tr>
                <td>
                    <h2 style="font-size: 1.2rem">RECEPCIÓN DE EQUIPOS</h2>
                </td>
            </tr>
        </thead>
    </table>

    <table class="general_data">
        <tbody>
            <tr>
                <td>
                    <p><b>FECHA DE RECIBO:</b> <span class="data_table">{{$reception->created_at}}</span></p>
                </td>
                <td>
                    <p><b>RECEPCIÓN #:</b> <span class="data_table">{{$reception->custom_id}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>CLIENTE:</b> <span class="data_table">{{$client->full_name}}</span></p>
                </td>
                <td>
                    <p><b>TIPO DE RECEPCIÓN:</b> <span class="data_table">{{$reception->type_of_job}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>CONTACTO:</b> <span class="data_table">{{$client->cell}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>TELEFONO / CELULAR:</b> <span class="data_table">{{$client->cellphone}}</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="title table-content">
        <thead>
            <tr>
                <td>
                    <h3  style="font-size: 1rem;">DATOS DEL EQUIPO</h3>
                </td>
            </tr>
        </thead>
    </table>

    <table class="general_data">
        <tbody>
            <tr>
                <td>
                    <p><b>TIPO EQUIPO:</b> <span class="data_table">{{$reception->equipment_type}}</span></p>
                </td>
                <td>
                    <p><b>INV. CLIENTE #:</b> <span class="data_table">{{$reception->customer_inventory}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>MARCA:</b> <span class="data_table">{{$reception->brand}}</span></p>
                </td>
                <td>
                    <p><b>UBICACION:</b> <span class="data_table">{{$reception->location}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>MODELO:</b> <span class="data_table">{{$reception->model}}</span></p>
                </td>
                <td>
                    <p><b>UBICACION ESPECIFICA:</b> <span class="data_table">{{$reception->specific_location}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>SERIE No:</b> <span class="data_table">{{$reception->serie}}</span></p>
                </td>
                <td>
                    <p><b>ESTADO:</b> <span class="data_table">{{$reception->state}}</span></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>CAPACIDAD:</b> <span class="data_table">{{$reception->capability}}</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="title table-content">
        <thead>
            <tr>
                <td>
                    <h3  style="font-size: 1rem;">REGISTRO FOTOGRAFICO DEL EQUIPO RECIBIDO</h3>
                </td>
            </tr>
        </thead>
    </table>
    <br>
    <table class="title table-content observations-box">
        <thead>
            <tr>
                <td>
                    <p style="font-size: 0.9rem; text-align: left;"><b>OBSERVACIONES:</b> {{$reception->comments}}</p>
                </td>
            </tr>
        </thead>
    </table>

    <table class="sign_data">
        <tbody>
            <tr>
                <td>
                    <br>
                    <br>
                    <span class="data_table_sign">
                    </span>
                    <p><b>RECIBIDO POR:</b></p>
                </td>
                <td>
                    <br>
                    <br>
                    <span class="data_table_sign">
                    </span>
                    <p ><b>ENTREGADO POR:</b></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="title table-content">
        <thead>
            <tr>
                <td>
                    <p style="font-size: 0.9rem; text-align: center;">Todos los derechos reservados &copy;2024 - CEES </p>
                </td>
            </tr>
        </thead>
    </table>
    <table class="general_data images">
        <tbody>
            @php
                $urlsArray = explode(",", $reception->photos);

                $cleanUrlsArray = array_map(function($url) {
                    return str_replace(env('SITE_URL'), "/public", str_replace(['\\', ' '], '', trim($url)));
                }, $urlsArray);

                // Foreach, 3 td to tr line
                $i = 0;
                $result = "";
                foreach($cleanUrlsArray as $url) {
                    $i++;
                    if ($i == 1) {
                        $result .= "<tr>";
                    }
                    if ($i % 4 == 0 ) {
                        $result .= "</tr>";
                        if ($i < count($cleanUrlsArray)) {
                            $result .= "<tr>";
                        }
                    }
                    $result .= "<td><img src='data:image/svg+xml;base64," . base64_encode(file_get_contents(base_path($url))) . " width='150'></td>";
                }
                echo $result;
            @endphp

        </tbody>
    </table>



</body>
</html>