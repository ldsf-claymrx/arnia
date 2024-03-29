@extends('masterdashboard')

@section('title')
    <title>ARNIA | Mi Perfil</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Mi Perfil</h1>
        <p class="mb-4" style="text-align: justify">
            Bienvenido {{ Auth::user()->name." ".Auth::user()->lastname }} a la sección de tu perfil, aqui se encuentra la informacion de tu
            cuenta de ARNIA, tienen todo el derecho para actualizarla si algo esta erroneo.
        </p>


        <!-- Content Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Mis Datos</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form id="form-profile">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Nombre(s):</label>
                                            <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Apellidos</label>
                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Clave de Acceso:</label>
                                <input type="text" class="form-control form-control-user" id="key_access" name="key_access" value="{{ Auth::user()->key_access }}" required>
                            </div>

                            <div class="form-group">
                                <label for="">Correo Electronico:</label>
                                <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="url" id="url" value="{{ url('/updateprofile') }}">
                            </div>
                            <input type="submit" class="btn btn-primary btn-user btn-block" disabled value="Actualizar mi Información">
                        </form>
                    </div>    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts-personales')
    
@endsection