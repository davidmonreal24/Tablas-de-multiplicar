<!--
    David Alejandro Monreal Vázquez
    Aplicaciones Web Interactivas
    Tarea 1: Tablas de multiplicar
    Frameworks & libraries: Laravel + Bootstrap + jQuery
    Ingeniería en Sistemas Inteligentes
    Facultad de Ingeniería
    Universidad Autónoma de San Luis Potosí
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .slide-fwd-center {
            -webkit-animation: slide-fwd-center 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-fwd-center 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        @-webkit-keyframes slide-fwd-center {
            0% {
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
            }

            100% {
                -webkit-transform: translateZ(160px);
                transform: translateZ(160px);
            }
        }

        @keyframes slide-fwd-center {
            0% {
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
            }

            100% {
                -webkit-transform: translateZ(160px);
                transform: translateZ(160px);
            }
        }

        .botonPress {
            background-color: red;
        }

        .operacion {
            font-size: 80pt;
            -webkit-animation: slide-fwd-center 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-fwd-center 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
    </style>

</head>

<body>
    <header>
        <div class="row">
            <div class="col-md-8">
                <h1>Tablas de multiplicar</h1>
            </div>
            <div class="col-md-4 mt-2">
                <button type="button" class="btn btn-danger" id="limpiar">Reiniciar</button>
            </div>
        </div>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                @for ($i = 1; $i <= 10; $i++) <button type="button" class="btn btn-primary btn-botones">{{ $i }}</button>
                    @endfor
            </div>
            <div class="col-md-2">
                <div class="dropdown">

                    <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dificultad
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="1">Fácil</a></li>
                        <li><a class="dropdown-item" href="#" id="2">Intermedio</a></li>
                        <li><a class="dropdown-item" href="#" id="3">Difícil</a></li>
                        <li><a class="dropdown-item" href="#" id="4">Extremo</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2" style="margin-left: 200px;">
                <button type="button" class="btn btn-success" id="comenzar">Comenzar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div id="operacion"></div>

            </div>
            <div class="col-md-2" style="width: 100px;">
                <div id="resultado"></div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var operaciones = []; // Array para almacenar las operaciones

            var resultados = [];

            // Evento click de los elementos .btn-botones
            $('.btn-botones').click(function() {
                $(this).addClass('botonPress');
                var selectedButton = $(this).text();
                var numeroRandom = Math.floor(Math.random() * 10) + 1;
                var res = selectedButton * numeroRandom;
                var operacion = selectedButton + ' x ' + numeroRandom + ' = \n';

                // Agregar la operación al array
                operaciones.push(operacion + '<br>');

                // Mostrar todas las operaciones en el elemento #operacion
                //$('#operacion').text(selectedButton + ' x ' + numeroRandom + ' = ');
                $('#operacion').html(operaciones.join(''));
                $('#operacion').addClass('operacion');
                resultados.push(res);
                console.log(resultados);

                //$("#comenzar").attr('dataRes', resultados);
                // $("#comenzar").attr('dataRes', res);
            });

            // Evento click de los elementos .dropdown-item
            $(".dropdown-item").click(function() {
                var delay;
                switch ($(this).attr('id')) {
                    case "1":
                        delay = 60000; // 1 minuto
                        break;
                    case "2":
                        delay = 30000; // 30 segundos
                        break;
                    case "3":
                        delay = 10000; // 10 segundos
                        break;
                    case "4":
                        delay = 5000; // 5 segundos
                        break;
                    default:
                        delay = 0; // Valor predeterminado
                }
                //Pasar valor de delay al elemento #comenzar
                $('#comenzar').attr('data-delay', delay);
            });

            // Evento click del elemento #comenzar (botón)
            $("#comenzar").click(function() {
                //Valor de dificultad
                var delayValue = $(this).attr('data-delay');
                //Arreglo de resultados
                // var answers = $(this).attr('dataRes');

                if (delayValue > 0) {
                    console.log("Entró al if")
                    $("#resultado").text(resultados.join('\n'));
                    $("#resultado").addClass('operacion');
                    $("#resultado").hide();
                    setTimeout(function() {
                        //Mostrar el elemento #resultado (debe ocultarse primero)
                        $("#resultado").show();
                    }, delayValue);
                    // Mostrar el resultado después del retardo de tiempo
                    //mostrarResultadosConRetardo(resultados, delayValue)
                } else {
                    // Si delayValue es igual a 0, mostrar un mensaje de error, pedir selección de dificultad
                    alert("Error: Por favor, seleccione una dificultad.");
                }
            });
            $('#limpiar').click(function() {
                operaciones = [];
                resultados = [];
                $('.btn-botones').removeClass('botonPress');
                $('#operacion').empty(); // Elimina el contenido de #operacion
                $('#resultado').empty(); // Elimina el contenido de #resultado
            });
        });
    </script>
</body>

</html>