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
            <h1 class="h4 mb-2 text-gray-800"><b>Ministerio Juvenil</b></h1>
            <p class="mb-4" style="text-align: justify">
                Reporte de inasistencias al culto de jovénes, las fechas seleccionadas para generar este reporte
                automaticamente son: <b>{{ $start_date->format('d-m-Y') }}</b> hasta el <b>{{ $end_date->format('d-m-Y') }}</b>
            </p>
        @elseif($category == 1)
            <!-- Page Heading -->
            <h1 class="h4 mb-2 text-gray-800"><b>Ministerio de Varones</b></h1>
            <p class="mb-4" style="text-align: justify">
                Reporte de inasistencias al culto de varones, las fechas seleccionadas para generar este reporte
                automaticamente son: <b>{{ $start_date->format('d-m-Y') }}</b> hasta el <b>{{ $end_date->format('d-m-Y') }}</b>
            </p>
        @elseif($category == 2)
            <!-- Page Heading -->
            <h1 class="h4 mb-2 text-gray-800"><b>Ministerio de Damas</b></h1>
            <p class="mb-4" style="text-align: justify">
                Reporte de inasistencias al culto de jovénes, las fechas seleccionadas para generar este reporte
                automaticamente son: <b>{{ $start_date->format('d-m-Y') }}</b> hasta el <b>{{ $end_date->format('d-m-Y') }}</b>
            </p>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if ($category == 3)
                    <a href="{{ url('/dashboard/download-report-young') }}" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-download"></i></span><span class="text">Descargar PDF</span></a>
                @elseif($category == 1)
                    <a href="{{ url('/dashboard/download-report-men') }}" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-download"></i></span><span class="text">Descargar PDF</span></a>
                @elseif($category == 2)
                    <a href="{{ url('/dashboard/download-report-woman') }}" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-download"></i></span><span class="text">Descargar PDF</span></a>
                @endif
            </div>
            <div class="card-body">
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
        </div>
@endsection

@section('scripts-personales')
@endsection