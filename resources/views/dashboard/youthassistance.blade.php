@extends('masterdashboard')

@section('title')
    <!-- Custom styles for this page -->
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>CCA - Jovénes</title>
@endsection

@section('PageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h4 mb-2 text-gray-800"><b>Tabla de Jovénes</b></h1>
        <p class="mb-4" style="text-align: justify">
            En esta sección, usted puede tomar asistencia de los Jovénes que entran al culto
            a nivel administrador u/o editor.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jovénes Registrados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Sexo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Sexo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($persons as $person)
                            <tr>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->lastname }}</td>
                                <td>
                                    @if ($person->sex === 1)
                                        <span class="badge badge-primary">Masculino</span>
                                    @elseif($person->sex === 2)
                                        <span class="badge badge-success">Femenino</span>
                                    @endif
                                </td>
                                <td><a href="tel:{{ $person->phone_number }}">{{ $person->phone_number }}</a></td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assistence{{$person->id}}"><i class="fas fa-fw fa-check"></i></button>
                                </td>

                                <div class="modal fade" id="assistence{{$person->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('/dashboard/jovenes') }}" method="POST" enctype="multipart/form-data">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Control de Asistencia</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        @csrf                                                        
                                                        <label>
                                                            Estas por confirmar la asistencia de {{ $person->name." ".$person->lastname }}, 
                                                            al culto de Jovenes; se registrara: @php echo date('d-m-Y'); @endphp
                                                            <br><br>
                                                            ¿Confirmas su asistencia?
                                                        </label>

                                                        <input type="hidden" name="id_person" value="{{ $person->id }}">
                                                        <input type="hidden" name="who_registered" value="{{ Auth::user()->id }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <input type="submit" class="btn btn-primary" value="Confirmar">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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