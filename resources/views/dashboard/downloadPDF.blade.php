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
                padding: 12px;
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
                <h2 style="text-align: center">-- Ministerio Juvenil --</h2>
                <br>
                <div>
                    Reporte de inasistencias al culto de jovénes, las fechas seleccionadas
                    para generar este reporte automaticamente son: <b>{{ $start_date->format('d-m-Y') }}</b> hasta el <b>{{ $end_date->format('d-m-Y') }}</b>
                </div>

            @elseif($category == 1)
                <h2 style="text-align: center">-- Ministerio de Varones --</h2>
                <br>
                <div>
                    Reporte de inasistencias al culto de varones, las fechas seleccionadas
                    para generar este reporte automaticamente son: <b>{{ $start_date->format('d-m-Y') }}</b> hasta el <b>{{ $end_date->format('d-m-Y') }}</b>
                </div>
            @elseif($category == 2)
                <h2 style="text-align: center">-- Ministerio de Damas --</h2>
                <br>
                <div>
                    Reporte de inasistencias al culto de mujeres, las fechas seleccionadas
                    para generar este reporte automaticamente son: <b>{{ $start_date->format('d-m-Y') }}</b> hasta el <b>{{ $end_date->format('d-m-Y') }}</b>
                </div>
            @endif
            <br><br>
            @foreach($data as $record)
                <div class="record">
                    <div class="name">{{ $record->name." ".$record->lastname }}</div>
                    <div class="dates">
                        Tiene en total: <b>{{ count($record->dates) }}</b> faltas<br>
                        Dias que faltó: <b>{{ implode(' ----- ', $record->dates) }}</b>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>