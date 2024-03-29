@extends('masterdashboard')

@section('title')
    <!-- Custom styles for this page -->
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>ARNIA - Personas</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabla de Personas</h1>
        <p class="mb-4" style="text-align: justify">
            En esta sección, usted puede visualizar, editar y eliminar a las personas registrados
            a nivel administrador u/o editor.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Personas Registradas</h6><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearpersona"><i class="fas fa-fw fa-check"></i> Registrar una persona</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Sexo</th>
                                <th>Fecha Nacimiento</th>
                                <th>Apodo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Sexo</th>
                                <th>Fecha Nacimiento</th>
                                <th>Apodo</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($persons as $person)
                            <tr>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->lastname }}</td>
                                <td>{{ $person->phone_number }}</td>
                                <td>{{ $person->email }}</td>
                                <td>{{ $person->address }}</td>
                                <td>{{ $person->sex }}</td>
                                <td>{{ $person->birthdate }}</td>
                                <td>{{ $person->nickname }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$person->id}}"><i class="fas fa-fw fa-pen"></i></button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{$person->id}}"><i class="fas fa-fw fa-trash"></i></button>
                                    </div>
                                </td>

                                <div class="modal fade" id="edit{{$person->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('person.update', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Estas por editar a {{ $person->name }}</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('PUT')                                                        

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Nombre(s):*</label>
                                                                        <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ $person->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Apellidos:*</label>
                                                                        <input type="text" class="form-control form-control-user" id="lastname" name="lastname" value="{{ $person->lastname }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Teléfono:</label>
                                                                        <input type="number" class="form-control form-control-user" id="phone_number" name="phone_number" value="{{ $person->phone_number }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Correo:</label>
                                                                        <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ $person->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">Dirección:</label>
                                                            <input type="text" class="form-control form-control-user" id="address" name="address" value="{{ $person->address }}">
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">Fecha Nacimiento:</label>
                                                            <input type="date" class="form-control form-control-user" id="birthdate" name="birthdate" value="{{ $person->birthdate }}">
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">Apodo:</label>
                                                            <input type="text" class="form-control form-control-user" id="nickname" name="nickname" value="{{ $person->nickname }}">
                                                        </div>
            
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Sexo:*</label>
                                                                        <select name="sex" id="sex" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="1">Masculino</option>
                                                                            <option value="2">Femenino</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Categoria:*</label>
                                                                        <select name="id_category" id="id_category" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">{{$category->name }}</option>
                                                                            @endforeach
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

                                <div class="modal fade" id="delete{{$person->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('person.destroy', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">¡Advertencia!</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <label for="">¿Estás seguro de eliminar a {{ $person->name }}?</label>
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






                    <div class="modal fade" id="crearpersona" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('/dashboard/personas') }}" method="POST" enctype="multipart/form-data">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Registrar una Persona</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            @csrf                                                      

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Nombre(s):*</label>
                                                            <input type="text" class="form-control form-control-user" id="name" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Apellidos:*</label>
                                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Teléfono:</label>
                                                            <input type="number" class="form-control form-control-user" id="phone_number" name="phone_number">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Correo:</label>
                                                            <input type="email" class="form-control form-control-user" id="email" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Dirección:</label>
                                                <input type="text" class="form-control form-control-user" id="address" name="address">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Fecha Nacimiento:</label>
                                                <input type="date" class="form-control form-control-user" id="birthdate" name="birthdate">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Apodo:</label>
                                                <input type="text" class="form-control form-control-user" id="nickname" name="nickname">
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Sexo:*</label>
                                                            <select name="sex" id="sex" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1">Masculino</option>
                                                                <option value="2">Femenino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Categoria:*</label>
                                                            <select name="id_category" id="id_category" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{$category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="who_registered" value="{{ Auth::user()->id }}">
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