<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .container {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
            }
            .record {
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #000;
                border-radius: 5px;
            }
            .name {
                font-size: 1.2em;
                font-weight: bold;
            }
            .dates {
                margin-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @if ($category == 3)
                <h1>Ministerio de Jovenes - Faltas</h1>
            @endif
            <h3>Fecha inicial: <b>{{ $start_date }}</b></h3>
            <h3>Fecha final: <b>{{ $end_date }}</b></h3>
            <br><br><br>
            @foreach($data as $record)
                <div class="record">
                    <div class="name">{{ $record->name }}</div>
                    <div class="dates">
                        Fechas de faltas: <b>{{ implode('-----', $record->dates) }}</b><br>
                        Total de faltas: <b>{{ count($record->dates) }}</b>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>