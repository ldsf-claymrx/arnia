@extends('masterdashboard')

@section('title')
    <title>CCA | 503 No Disponible</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="503">503</div>
            <p class="lead text-gray-800 mb-5"><b>EN CREACIÓN</b></p>
            <p class="text-gray-500 mb-0">Actualmente, estamos en creando este modulo, pronto estara disponible, gracias por tu comprensión</p>
            <a href="{{ url('/dashboard') }}">&larr; Regresar al principio</a><br>
            <span>Created by <a href="https://www.instagram.com/davidclaymrx/" target="_blank" rel="davidclaymrx">DavidClayMRX</a></span>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts-personales')
    
@endsection