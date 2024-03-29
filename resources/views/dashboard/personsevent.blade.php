@extends('masterdashboard')

@section('title')
    <!-- Custom styles for this page -->
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>ARNIA - Asignar Personas a un Evento</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Asignar Persona a un Evento</h1>
        <p class="mb-4" style="text-align: justify">
            En esta sección, usted podra asignar a las personas que ya se tiene registradas
            a un evento que tambien ya esta registrado, asi como tambien podra editar y eliminar.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Personas Asignadas a un Evento</h6><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#asignarpersona"><i class="fas fa-fw fa-check"></i> Asignar una Persona</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Persona</th>
                                <th>Iglesia</th>
                                <th>Evento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Persona</th>
                                <th>Iglesia</th>
                                <th>Evento</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($personsEvents as $personEvent)
                            <tr>
                                <td>{{ $personEvent->id_person }}</td>
                                <td>{{ $personEvent->id_church }}</td>
                                <td>{{ $personEvent->id_event }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$personEvent->id}}"><i class="fas fa-fw fa-pen"></i></button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{$personEvent->id}}"><i class="fas fa-fw fa-trash"></i></button>
                                    </div>
                                </td>

                                <div class="modal fade" id="edit{{$personEvent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('asigperson.update', $personEvent->id) }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Editar</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('PUT')                                                        

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Persona:*</label>
                                                                        <select name="id_person" id="id_person" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            @foreach ($persons as $person)
                                                                            <option value="{{ $person->id }}">{{ $person->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
            
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="">Iglesia:*</label>
                                                                        <select name="id_church" id="id_church" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            @foreach ($churchs as $church)
                                                                            <option value="{{ $church->id }}">{{ $church->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="form-group">
                                                                        <label for="">Evento:*</label>
                                                                        <select name="id_event" id="id_event" class="form-control form-control-user" required>
                                                                            <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                            @foreach ($events as $event)
                                                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
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

                                <div class="modal fade" id="delete{{$personEvent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('asigperson.destroy', $personEvent->id) }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">¡Advertencia!</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <label for="">¿Estás seguro de eliminar a {{ $personEvent->id_person }}?</label>
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






                    <div class="modal fade" id="asignarpersona" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{url('/dashboard/asignarpersona')}}" method="POST" enctype="multipart/form-data">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Asignar Persona</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            @csrf
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Persona:*</label>
                                                            <select name="id_person" id="id_person" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                @foreach ($persons as $person)
                                                                <option value="{{ $person->id }}">{{ $person->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Iglesia:*</label>
                                                            <select name="id_church" id="id_church" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                @foreach ($churchs as $church)
                                                                <option value="{{ $church->id }}">{{ $church->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label for="">Evento:*</label>
                                                            <select name="id_event" id="id_event" class="form-control form-control-user" required>
                                                                <option value="0" selected disabled>--Seleccione una opción--</option>
                                                                @foreach ($events as $event)
                                                                <option value="{{ $event->id }}">{{ $event->name }}</option>
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