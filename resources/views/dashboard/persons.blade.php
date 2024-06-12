@extends('masterdashboard')

@section('title')
    <!-- Custom styles for this page -->
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>CCA - Personas</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h4 mb-2 text-gray-800"><b>Tabla de Personas</b></h1>
        <p class="mb-4" style="text-align: justify">
            En esta sección, usted puede visualizar, editar y eliminar a las personas registrados
            a nivel administrador u/o editor.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: "success",
                    title: `{{ session('success') }}`
                });
            </script>
        @endif


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
                                <th>Fecha Nacimiento</th>
                                <th>Categoria</th>
                                <th>Sexo</th>
                                <th>Estado Civil</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Facebook</th>
                                <th>Correo</th>
                                <th>Medio Comunicación</th>
                                <th>¿Quien te invito?</th>
                                <th>¿Se congrega?</th>
                                <th>¿Gusta recordatorios?</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Fecha Nacimiento</th>
                                <th>Categoria</th>
                                <th>Sexo</th>
                                <th>Estado Civil</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Facebook</th>
                                <th>Correo</th>
                                <th>Medio Comunicación</th>
                                <th>¿Quien te invito?</th>
                                <th>¿Se congrega?</th>
                                <th>¿Gusta recordatorios?</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($persons as $person)
                            <tr>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->lastname }}</td>
                                <td>{{ $person->birthdate }}</td>
                                <td style="text-align: center">
                                    @if ($person->category == 1)
                                        <span class="badge badge-primary">Señor</span>
                                    @elseif($person->category == 2)
                                        <span class="badge badge-warning">Señora</span>
                                    @elseif($person->category == 3)
                                        <span class="badge badge-success">Joven</span>
                                    @elseif($person->category == 4)
                                        <span class="badge badge-light">Señorita</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($person->sex === 1)
                                        <span class="badge badge-primary">Masculino</span>
                                    @elseif($person->sex === 2)
                                        <span class="badge badge-success">Femenino</span>
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    @if ($person->civil_status == 1)
                                        Casado(a)
                                    @elseif($person->civil_status == 2)
                                        Divorciado(a)
                                    @elseif($person->civil_status == 3)
                                        Union Libre
                                    @elseif($person->civil_status == 4)
                                        Viudo(a)
                                    @elseif($person->civil_status == 5)
                                        Soltero(a)
                                    @elseif($person->civil_status == 6)
                                        Otro
                                    @endif
                                </td>
                                <td>{{ $person->address }}</td>
                                <td><a href="tel:{{ $person->phone_number }}">{{ $person->phone_number }}</a></td>
                                <td>{{ $person->facebook }}</td>
                                <td><a href="mailto:{{ $person->email }}">{{ $person->email }}</a></td>
                                <td>
                                    @if ($person->media == 1)
                                        Volante
                                    @elseif($person->media == 2)
                                        Facebook
                                    @elseif($person->media == 3)
                                        Radio
                                    @elseif($person->media == 4)
                                        Invitación Personal
                                    @endif
                                </td>
                                <td>{{ $person->personal_invitation }}</td>
                                <td>
                                    @if ($person->do_you_congregate == 1)
                                        Si
                                    @elseif($person->do_you_congregate == 2)
                                        No                                        
                                    @endif
                                </td>
                                <td>
                                    @if ($person->reminders == 1)
                                        Si
                                    @elseif($person->reminders == 2)
                                        No                                        
                                    @endif
                                </td>
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
                                                        <h6 class="m-0 font-weight-bold text-primary">Editar Contacto</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('PUT')                                                        

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Nombre(s):</label><label style="color: red">*</label>
                                                                        <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ $person->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Apellidos:</label>
                                                                        <input type="text" class="form-control form-control-user" id="lastname" name="lastname" value="{{ $person->lastname }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">Fecha Nacimiento:</label>
                                                            <input type="date" class="form-control form-control-user" id="birthdate" name="birthdate" value="{{ $person->birthdate }}">
                                                        </div>
            
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Categoria:</label><label style="color: red">*</label>
                                                                        <select name="category" id="category" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="1" {{ ($person->category == 1) ? 'selected' : '' }} >Señor</option>
                                                                            <option value="2" {{ ($person->category == 2) ? 'selected' : '' }}>Señora</option>
                                                                            <option value="3" {{ ($person->category == 3) ? 'selected' : '' }} >Joven</option>
                                                                            <option value="4" {{ ($person->category == 4) ? 'selected' : '' }} >Señorita</option>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Sexo:</label><label style="color: red">*</label>
                                                                        <select name="sex" id="sex" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="1" {{ ($person->sex == 1) ? 'selected' : '' }} >Masculino</option>
                                                                            <option value="2" {{ ($person->sex == 2) ? 'selected' : '' }} >Femenino</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
            
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Estado Civil:</label><label style="color: red">*</label>
                                                                        <select name="civil_status" id="civil_status" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            <option value="1" {{ ($person->civil_status == 1) ? 'selected' : '' }}>Casado(a)</option>
                                                                            <option value="2" {{ ($person->civil_status == 2) ? 'selected' : '' }}>Divorciado(a)</option>
                                                                            <option value="3" {{ ($person->civil_status == 3) ? 'selected' : '' }}>Union Libre</option>
                                                                            <option value="4" {{ ($person->civil_status == 4) ? 'selected' : '' }}>Viudo(a)</option>
                                                                            <option value="5" {{ ($person->civil_status == 5) ? 'selected' : '' }}>Soltero(a)</option>
                                                                            <option value="6" {{ ($person->civil_status == 6) ? 'selected' : '' }}>Otro</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">Dirección:</label>
                                                            <input type="text" class="form-control form-control-user" id="address" name="address" value="{{ $person->address }}">
                                                        </div>
            
            
            
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Teléfono:</label>
                                                                        <input type="number" class="form-control form-control-user" id="phone_number" name="phone_number" value="{{ $person->phone_number }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Facebook:</label>
                                                                        <input type="text" class="form-control form-control-user" id="facebook" name="facebook" value="{{ $person->facebook }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">Correo:</label>
                                                                        <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ $person->email }}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">¿Como te enteraste de esta congregación?:</label><label style="color: red">*</label>
                                                            <select name="media" id="media" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1" {{ ($person->media == 1) ? 'selected' : '' }}>Volante</option>
                                                                <option value="2" {{ ($person->media == 2) ? 'selected' : '' }}>Facebook</option>
                                                                <option value="3" {{ ($person->media == 3) ? 'selected' : '' }}>Radio</option>
                                                                <option value="4" {{ ($person->media == 4) ? 'selected' : '' }}>Invitación Personal</option>
                                                            </select>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="">¿De quien?:</label>
                                                            <input type="text" class="form-control form-control-user" id="personal_invitation" name="personal_invitation" placeholder="--Llenar en caso que fue una invitación personal--" value="{{ $person->personal_invitation }}">
                                                            <small id="" class="form-text text-muted">En caso de que fue una invitación personal, ingrese el nombre de la persona que lo invito.</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">¿Asistes a otra iglesia actualmente?:</label><label style="color: red">*</label>
                                                            <select name="do_you_congregate" id="do_you_congregate" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1" {{ ($person->do_you_congregate == 1) ? 'selected' : '' }}>Si</option>
                                                                <option value="2" {{ ($person->do_you_congregate == 2) ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">¿Deseas recordatorios?:</label><label style="color: red">*</label>
                                                            <select name="reminders" id="reminders" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1" {{ ($person->reminders == 1) ? 'selected' : '' }}>Si</option>
                                                                <option value="2" {{ ($person->reminders == 2) ? 'selected' : '' }}>No</option>
                                                            </select>
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
                                                            <label for="">Nombre(s):</label><label style="color: red">*</label>
                                                            <input type="text" class="form-control form-control-user" id="name" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Apellidos:</label>
                                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Fecha Nacimiento:</label>
                                                <input type="date" class="form-control form-control-user" id="birthdate" name="birthdate">
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Categoria:</label><label style="color: red">*</label>
                                                            <select name="category" id="category" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1">Señor</option>
                                                                <option value="2">Señora</option>
                                                                <option value="3">Joven</option>
                                                                <option value="4">Señorita</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Sexo:</label><label style="color: red">*</label>
                                                            <select name="sex" id="sex" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1">Masculino</option>
                                                                <option value="2">Femenino</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Estado Civil:</label><label style="color: red">*</label>
                                                            <select name="civil_status" id="civil_status" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                <option value="1">Casado(a)</option>
                                                                <option value="2">Divorciado(a)</option>
                                                                <option value="3">Union Libre</option>
                                                                <option value="4">Viudo(a)</option>
                                                                <option value="5">Soltero(a)</option>
                                                                <option value="6">Otro</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Dirección:</label>
                                                <input type="text" class="form-control form-control-user" id="address" name="address">
                                            </div>



                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Teléfono:</label>
                                                            <input type="number" class="form-control form-control-user" id="phone_number" name="phone_number">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Facebook:</label>
                                                            <input type="text" class="form-control form-control-user" id="facebook" name="facebook">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label for="">Correo:</label>
                                                            <input type="email" class="form-control form-control-user" id="email" name="email">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">¿Como te enteraste de esta congregación?:</label><label style="color: red">*</label>
                                                <select name="media" id="media" class="form-control form-control-user" required>
                                                    <option value="0" selected disabled>--Seleccione una opción--</option>
                                                    <option value="1">Volante</option>
                                                    <option value="2">Facebook</option>
                                                    <option value="3">Radio</option>
                                                    <option value="4">Invitación Personal</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">¿De quien?:</label>
                                                <input type="text" class="form-control form-control-user" id="personal_invitation" name="personal_invitation" placeholder="--Llenar en caso que fue una invitación personal--">
                                                <small id="" class="form-text text-muted">En caso de que fue una invitación personal, ingrese el nombre de la persona que lo invito.</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="">¿Asistes a otra iglesia actualmente?:</label><label style="color: red">*</label>
                                                <select name="do_you_congregate" id="do_you_congregate" class="form-control form-control-user" required>
                                                    <option value="0" selected disabled>--Seleccione una opción--</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">¿Deseas recordatorios?:</label><label style="color: red">*</label>
                                                <select name="reminders" id="reminders" class="form-control form-control-user" required>
                                                    <option value="0" selected disabled>--Seleccione una opción--</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
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