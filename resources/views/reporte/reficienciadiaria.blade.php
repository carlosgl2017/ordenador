<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script async src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS-MML_CHTML"></script>
    <style>
        body {
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 0px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 7;
            text-align: justify;
        }
        table {
            width: 80%;
            border: 1px solid #000;
        }

        th,
        td {
            width: auto;
            text-align: left;
            vertical-align: top;
            border: 1px solid #000;
            border-spacing: 0;
        }

        .titulo {
            font-weight: bold;
            text-align: center;
        }

        .footer-color {
            background: #FBFAF8;
            text-align: center;
            font-weight: bold;
        }

        .logo {
            height: 50;
            width: 50;
        }

        .indiceeficiencia {
            text-align: center;
        }

        .negrita {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div>
        <img class="logo" src="img/logoOficial.png">
    </div>

    <div id="titulo">
        <p class="titulo">REPORTE ÍNDICE DE EFICIENCIA DE ATENCIÓN</p>
    </div>
    <br>
    <div>
        <table style="margin:auto">
            <tr>
                <td class="negrita">Fecha del reporte:</td>
                <td>{{$date}}</td>
            </tr>
            <tr>
                <td class="negrita">Área</td>
                <td>{{$area}}</td>
            </tr>
            <tr>
                <td class="negrita">Número de atenciones en caja que exceden los 30 minutos </td>
                <td>{{$totalmayor}}</td>
            </tr>
            <tr>
                <td class="negrita">Número total de atenciones en el día </td>
                <td>{{$total}}</td>
            </tr>

            <tr>
                <td class="negrita">Fórmula Índice de eficiencia parcial de atención</td>
                <td> <center><img src="img/formula.png" height="20" width="100"></center> </td>
            </tr>
        </table>
    </div>

    <br>
    <div>
        <table style="margin:auto">
            <tr>
                <td>
                    <strong>Cálculo del indice de eficiencia de atención= Iepc = {{round($indice,2)}}%</strong>
                </td>
            </tr>
        </table>
    </div>

    <br>
    <?php
    $contar = 1;
    ?>
    <div id="contenido">
        <table border="1" style="overflow-x: auto; margin:auto">
            <thead style="background-color: #698F3F; color:white">
                <tr>
                    <th>Nro</th>
                    <th>Nro ticket</th>
                    <th>Área</th>
                    <th>Emitido</th>
                    <th>Atendido</th>
                    <th>Tiempo de espera</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tickets as $ti)
                <tr>
                    <td>{{$contar}}</td>
                    <td>{{$ti->nroticket}}</td>
                    <td>{{$ti->servicio}}</td>
                    <td>{{$ti->emitido}}</td>
                    <td>{{$ti->atendido}}</td>
                    <td>{{gmdate("H:i:s",\Carbon\Carbon::parse($ti->atendido)->diffInSeconds(\Carbon\Carbon::parse($ti->emitido)))}}</td>
                </tr>
                {{$contar++}}
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- <footer>
        <img src="web/img/pie.png" width="100%" height="100%">
    </footer> -->
</body>


</html>