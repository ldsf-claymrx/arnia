@extends('masterdashboard')

@section('title')
    <!-- Custom styles for this page -->
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>CCA - Reporte Faltas</title>
    <style>
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
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if ($category == 3)
            <!-- Page Heading -->
            <h1 class="h4 mb-2 text-gray-800"><b>Ministerio de Jovenes - Faltas</b></h1>
            <p class="mb-4" style="text-align: justify">
                La informacion mostrada es un reporte de la inasistencia al culto de jovenes,
                este reporte es mensual, por lo que puede marcar falta a fechas que aun no hemos llegado,
                este reporte tiene como fecha inicial: <b>{{ $start_date }}</b> y tiene como fecha final: <b>{{ $end_date }}</b>

            </p>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if ($category == 3)
                    <a href="{{ url('/dashboard/download-report-young') }}" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-download"></i></span><span class="text">Descargar PDF</span></a>
                @endif
            </div>
            <div class="card-body">
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
        </div>
@endsection

@section('scripts-personales')
@endsection