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
                <h3 class="card-title">::Empleados ::</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
        </div>
    </div>
    <div class="card col-md-12">
        <div class="card-header">
            <h3 class="card-title">:: Lista de Empleados ::</h3>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

        </div>
        {{-- <div
            style="background-color: #776a6a; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-top: 20px;">
            @if (count($empleados) > 0)
                <h3>En el Departamento de:</h3>
                <h4>{{ $empleados[0]->nombreDepa }}</h4>
            @endif
            <h3>El Total de empleados es:</h3>
            <h4>${{ $countEmpleados }}</h4>
        </div> --}}

        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Departamentos</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Puesto</th>
                        <th>Salario</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($empleados as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombreDepa }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->apellido }}</td>
                            <td>{{ $item->puesto }}</td>
                            <td>{{ $item->salario }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    {{-- <form action="{{ route('calcularTotalVentas') }}" method="post">
        @csrf
        <label for="fecha_seleccionada">Fecha Seleccionada:</label>
        <input type="date" name="fecha_seleccionada" required>
        <button type="submit">Calcular Total Ventas</button>
    </form> --}}
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
