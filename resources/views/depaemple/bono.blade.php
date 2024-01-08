@extends('plantilla.app')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('contenido')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">:: Bono en Empleados ::</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('bono', $empleado->id) }}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Departamento</label>
                        <select name="depa_id">
                            @foreach ($departamentos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombreDepa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Departamento</label>
                        <input type="text" value="{{ $empleado->depa_id }}" name="nombreDepa" class="form-control"
                            placeholder="Nombre Departamento">
                    </div>

                    <div class="form-group">
                        <input type="text" value="{{ $empleado->nombre }}" name="nombre" class="form-control"
                            placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input disabled type="text" value="{{ $empleado->apellido }}" name="apellido"
                            class="form-control" placeholder="apellido">
                    </div>
                    <div class="form-group">
                        <input disabled type="text" value="{{ $empleado->puesto }}" name="puesto" class="form-control"
                            placeholder="puesto">
                    </div>
                    <div class="form-group">
                        <input disabled type="text" value="{{ $empleado->salario }}" name="salario" class="form-control"
                            placeholder="salario">
                    </div>
                    <div class="form-group">
                        <input type="text" name="bonoempleado" class="form-control"
                            placeholder="Ingrese el bono del empleado">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Registrar Bono</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
