@extends('masterdashboard')

@section('title')
    <title>CCA | Mi Perfil</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h4 mb-2 text-gray-800"><b>Mi Perfil</b></h1>
        <small id="emailHelp" class="form-text text-muted">
            ¡Hola! Si es la primera vez que ingresas, por seguridad te sugerimos actualizar tu contraseña.
        </small><br>


        <!-- Content Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Foto de perfil</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div style="text-align: center">
                            @if (Auth::user()->sex === 1)
                                <img class="img-profile rounded-circle" style="width: 200px" src="{{ asset('img/undraw_hombres.svg') }}">
                            @elseif (Auth::user()->sex === 2)
                                <img class="img-profile rounded-circle" style="width: 200px" src="{{ asset('img/undraw_mujeres.svg') }}">
                            @endif
                            
                            <p class="mb-4">JPG or PNG no langer than 5 MB</p>
                            <input type="submit" class="btn btn-primary btn-user" value="Upload new image" disabled>
                        </div>
                    </div>    
                </div> 
            </div>

            <div class="col-xl-8 col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detalles de la Cuenta</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form id="form-profile">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="lname">Nombre(s):</label>
                                            <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="llastname">Apellidos:</label>
                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="lemail">Correo Electronico:</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ Auth::user()->email }}" disabled required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="lposition">Tu cargo en la congregación:</label>
                                            <select name="position" id="position" class="form-control form-control-user" required>
                                                <option value="" selected disabled>--Seleccione una opción--</option>
                                                <option value="Pastorado" {{ (Auth::user()->position == 'Pastorado' ? 'selected' : '') }}>Pastorado</option>
                                                <option value="Lider" {{ (Auth::user()->position == 'Lider' ? 'selected' : '') }}>Líder</option>
                                                <option value="Levita" {{ (Auth::user()->position == 'Levita' ? 'selected' : '') }}>Levita</option>
                                                <option value="Servidor" {{ (Auth::user()->position == 'Servidor' ? 'selected' : '') }}>Servidor</option>
                                                <option value="Intercesor" {{ (Auth::user()->position == 'Intercesor' ? 'selected' : '') }}>Intercesor</option>
                                                <option value="N/A" {{ (Auth::user()->position == 'N/A' ? 'selected' : '') }}>Ninguno</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lpassword">Contraseña:</label>
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="--Ingresa la contraseña--" required>
                                <small id="emailHelp" class="form-text text-muted">Para actualizar, es necesario ingresar tu contraseña actual o una nueva que desees.</small>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="url" id="url" value="{{ url('/updateprofile') }}">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                            </div>
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Actualizar mi Información">
                        </form>
                    </div>    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts-personales')
    <script src="{{ asset('js/updateMyInfo.js') }}"></script>
@endsection