@extends('masterdashboard')

@section('title')
    <title>ARNIA | Principal</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Bienvenido a ARNIA&reg;</h1>
        <p class="mb-4" style="text-align: justify;">
            ARNIA&reg; es un sistema, que tiene el objetivo agilizar procesos de registro 
            para nuevos creyentes, eventos (congresos, desayunos, RAF's, conferencias, etc.), reportes de personas asistentes 
            a un evento, reporte de identificación de creyentes para visitas, asistencias para escuela ministerial, entre otras
            muchas funciones más. Todo en este sistema centralizado llamado ARNIA&reg;. Aquí podras consultar, agregar, editar y
            eliminar difentes tipos de datos.
        </p>

        <h1 class="h5 mb-2 text-gray-800"><b>¿Por qué ARNIA?</b></h1>
        <p class="mb-4" style="text-align: justify">
            ARNIA&reg;, viene del italiano que significa "Colmena". La colmena es una representación de la iglesia
            y las abejas la representación de nosotros mismos; que lo dan todo y trabajan por la misma. Esperamos que sea 
            de mucha bendición este sistema para ustedes.
        </p>
        



        <!-- Content Row -->
        <div class="row">

            <!-- Donut Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Genero de las Personas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <hr>
                        Calculo grafico en porcentajes de Mujeres y Hombre
                        que asisten a la Iglesia.
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts-personales')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endsection