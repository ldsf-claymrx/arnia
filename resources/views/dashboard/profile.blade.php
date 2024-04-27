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
            Bienvenido <b>{{ Auth::user()->name." ".Auth::user()->lastname }} </b> a la sección de tu perfil, 
            aqui se encuentra la informacion de tu cuenta de ARNIA, teniendo todo el derecho para actualizarla
            si algo esta erroneo. Tambien si es la primera vez que entras, te sugerimos, actualizar tu
            contraseña, esto para no tener la contraseña por defecto, que es 1234. Si el correo es incorrecto,
            ponte en contacto con el administrador de ARNIA.
        </p>


        <!-- Content Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos de la cuenta - {{ Auth::user()->email }}</h6>
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