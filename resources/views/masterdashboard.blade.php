@php
    if (Auth::user()->active == 1) {
    }else {
        header('Location: '. url('/logout'));
        exit;
    }
@endphp


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="AxolotitoPC SA de CV">

    @yield('title')

    <!-- Custom fonts for this template-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/logo-oficial-transparente-blanco.png') }}" style="width: 30px;" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">CCA &reg;</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Principal</span></a>
            </li>

            @if (Auth::user()->authorization_level == "SUPERADMIN")
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Usuarios CCA</div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                        <i class="fas fa-fw fa-lock"></i>
                        <span>Administrador</span>
                    </a>
                    <div id="collapse0" class="collapse" aria-labelledby="heading0" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">--Opciones--</h6>
                            <a class="collapse-item" href="{{ url('/dashboard/usuarios') }}">Usuarios Sistema</a>
                        </div>
                    </div>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Personas
            </div>

            <!-- Nav Item - Usuarios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Personas</span>
                </a>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Opciones--</h6>
                        <a class="collapse-item" href="{{ url('/dashboard/personas') }}">Consultar</a>
                        <!--<a class="collapse-item" href="">Reportes y Estadisticas</a>-->
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Ministerios
            </div>

            <!-- Nav Item - Usuarios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Jovénes</span>
                </a>
                <div id="collapse2" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Opciones--</h6>
                        <a class="collapse-item" href="{{ url('/dashboard/jovenes') }}">Asistencia</a>
                        <a class="collapse-item" href="{{ url('/dashboard/503') }}">Reportes</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Usuarios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    <i class="fas fa-fw fa-male"></i>
                    <span>Varones</span>
                </a>
                <div id="collapse3" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Opciones--</h6>
                        <a class="collapse-item" href="{{ url('/dashboard/varones') }}">Asistencia</a>
                        <a class="collapse-item" href="{{ url('/dashboard/503') }}">Reportes</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Usuarios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <i class="fas fa-fw fa-female"></i>
                    <span>Mujeres</span>
                </a>
                <div id="collapse4" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Opciones--</h6>
                        <a class="collapse-item" href="{{ url('/dashboard/mujeres') }}">Asistencia</a>
                        <a class="collapse-item" href="{{ url('/dashboard/503') }}">Reportes</a>
                    </div>
                </div>
            </li>

            















            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
        
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name." ".Auth::user()->lastname }}</span>
                                @if (Auth::user()->sex === 1)
                                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_hombres.svg') }}">
                                @elseif (Auth::user()->sex === 2)
                                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_mujeres.svg') }}">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/dashboard/perfil') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mi Perfil
                                </a>

                                @if (Auth::user()->authorization_level == "SUPERADMIN" || Auth::user()->authorization_level == "ADMIN")
                                    <a class="dropdown-item" href="{{ url('/dashboard/503') }}"><i class="fas fa-fw fa-church fa-sm fa-fw mr-2 text-gray-400"></i> Iglesias </a>
                                    <a class="dropdown-item" href="{{ url('/dashboard/503') }}"><i class="fas fa-fw fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Eventos </a>
                                @endif

                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
        
                </nav>
                <!-- End of Topbar -->

                @yield('PageContent')
        
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Derechos Reservados ARNIA&reg; 2024</span><br>
                        <span>Created by <a href="https://www.instagram.com/davidclaymrx/" target="_blank" rel="davidclaymrx">DavidClayMRX</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ url('/logout') }}">Cerrar Sesión</a>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('scripts-personales')

</body>

</html>