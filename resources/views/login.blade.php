<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="ARNIA">
        <meta name="author" content="Powered by GNoSys&reg;">

        <title>ARNIA | Login</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-header text-center">
                            <img src="{{ asset('img/logo-oficial-transparente.png') }}" style="width: 50px" alt="">
                        </div>
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenido(a) - ARNIA</h1>
                                </div>

                                <form action="" method="post">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="">Correo Electronico:</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="--Ingrese su correo--">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Contraseña:</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="--Ingrese la contraseña--">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>


                                    <input type="submit" class="btn btn-warning btn-block" value="Ingresar">
                                </form>
                                <div class="text-justify pt-4">
                                    <hr>
                                    <p>
                                        <b>RECORDATORIO:</b><br>
                                        Este sistema es una versión inestable, lo que significa que 
                                        está propenso a errores, ya que se está probando por primera vez en uso realista, 
                                        su propósito es obtener información realista, para realizar nuevas pruebas y que 
                                        lo prueben y sean de gran contribución al proyecto. <br><br>

                                        Se ha considerado a usted como una persona madura, para el manejo de esta 
                                        información, por lo cual  se le pide <b>discreción con el proyecto.</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        @error('Notificacion')
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: `{{ $message }}`
                });
            </script>
        @enderror

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    </body>

</html>