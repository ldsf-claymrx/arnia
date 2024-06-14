<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .h4 {
                color: rgb(107, 107, 107);
                font-weight: 700;
                text-align: center;
            }

            .table {
                font-weight: 400;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <br><br><br>
            <h1 class="h4"><b>Cumpleaños</b></h1>

            <br><br>

            @if($personsWithBirthdays->isEmpty())
                <h3 class="h4"><b>Este mes no hay cumpleaños</b></h3>
            @else
                <table class="table" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Fecha de Nacimiento</th>
                        </tr>
                    </thead><br>
                    <tbody>
                        @foreach ($personsWithBirthdays as $personWithBirthday)
                            <tr>
                                <td>{{ $personWithBirthday->name }}</td>
                                <td>{{ $personWithBirthday->lastname }}</td>
                                <td>{{ $personWithBirthday->birthdate }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div style="text-align: center;">
                <img src="http://imgfz.com/i/XvTIGmE.png" alt="BirthDay ARNIA" style="width: 80%;">
            </div>
            
        </div>
    </body>
</html>