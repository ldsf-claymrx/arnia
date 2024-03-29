@php
    if (Auth::user()->authorization_level == "SUPERADMIN") {
    }else {
        header('Location: '. url('/dashboard'));
        exit;
    }
@endphp

@extends('masterdashboard')

@section('title')
    <!-- Custom styles for this page -->
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>ARNIA | Usuarios ARNIA</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabla de Usuarios</h1>
        <p class="mb-4" style="text-align: justify">
            En esta sección, usted puede visualizar, editar y eliminar los usuarios registrados
            a nivel administrador u/o editor.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Usuarios Registrados</h6><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearusuario"><i class="fas fa-fw fa-check"></i> Registrar un Usuario</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Clave Acceso</th>
                                <th>Posicion</th>
                                <th>Correo</th>
                                <th>Nivel</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Clave Acceso</th>
                                <th>Posicion</th>
                                <th>Correo</th>
                                <th>Nivel</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->lastname }}</td>
                                <td>{{ $usuario->key_access }}</td>
                                <td>{{ $usuario->position }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->authorization_level }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$usuario->id}}"><i class="fas fa-fw fa-pen"></i></button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{$usuario->id}}"><i class="fas fa-fw fa-trash"></i></button>
                                    </div>
                                </td>

                                <div class="modal fade" id="edit{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('userarnia.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Estas por editar a {{ $usuario->name }}</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('PUT')                                                        

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Nombre(s):</label>
                                                                        <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ $usuario->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Apellidos</label>
                                                                        <input type="text" class="form-control form-control-user" id="lastname" name="lastname" value="{{ $usuario->lastname }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Clave de Acceso:</label>
                                                            <input type="text" class="form-control form-control-user" id="key_access" name="key_access" value="{{ $usuario->key_access }}" required>
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label for="">Correo Electronico:</label>
                                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ $usuario->email }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Contraseña:</label>
                                                            <input type="password" class="form-control form-control-user" id="password" name="password" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Cargo:</label>
                                                                        <select name="position" id="position" class="form-control form-control-user" required>
                                                                            <option value="" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="Pastorado">Pastorado</option>
                                                                            <option value="Lider">Líder</option>
                                                                            <option value="Levita">Levita</option>
                                                                            <option value="Servidor">Servidor</option>
                                                                            <option value="Intercesor">Intercesor</option>
                                                                            <option value="Tester ARNIA">Tester ARNIA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Activo:</label>
                                                                        <select name="activo" id="activo" class="form-control form-control-user" required>
                                                                            <option value="" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="1">Si</option>
                                                                            <option value="2">No</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Nivel:</label>
                                                                        <select name="authorization_level" id="authorization_level" class="form-control form-control-user" required>
                                                                            <option value="" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="SUPERADMIN">Super Administrador</option>
                                                                            <option value="ADMIN">Administrador</option>
                                                                            <option value="PERSONAL">Personal</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <input type="submit" class="btn btn-primary" value="Editar">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('userarnia.destroy', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">¡Advertencia!</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <label for="">¿Estás seguro de eliminar a {{ $usuario->name }}?</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <input type="submit" class="btn btn-primary" value="Eliminar">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('/dashboard/usuariosarnia') }}" method="POST" enctype="multipart/form-data">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Registrar un Usuario</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            @csrf
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Nombre(s):</label>
                                                            <input type="text" class="form-control form-control-user" id="name" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Apellidos</label>
                                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Clave de Acceso:</label>
                                                <input type="text" class="form-control form-control-user" id="key_access" name="key_access" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Correo Electronico:</label>
                                                <input type="email" class="form-control form-control-user" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Contraseña:</label>
                                                <input type="password" class="form-control form-control-user" id="password" name="password" required>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Cargo:</label>
                                                            <select name="position" id="position" class="form-control form-control-user" required>
                                                                <option value="" selected disabled>--Seleccione una opción--</option>
                                                                <option value="Pastorado">Pastorado</option>
                                                                <option value="Lider">Líder</option>
                                                                <option value="Levita">Levita</option>
                                                                <option value="Servidor">Servidor</option>
                                                                <option value="Intercesor">Intercesor</option>
                                                                <option value="Tester ARNIA">Tester ARNIA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Activo:</label>
                                                            <select name="activo" id="activo" class="form-control form-control-user" required>
                                                                <option value="" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Nivel:</label>
                                                            <select name="authorization_level" id="authorization_level" class="form-control form-control-user" required>
                                                                <option value="" selected disabled>--Seleccione una opción--</option>
                                                                <option value="SUPERADMIN">Super Administrador</option>
                                                                <option value="ADMIN">Administrador</option>
                                                                <option value="PERSONAL">Personal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <input type="submit" class="btn btn-primary" value="Registrar">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts-personales')
    <!-- Page level plugins -->
    <script src="{{ url('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('js/demo/datatables-demo.js') }}"></script>
@endsection