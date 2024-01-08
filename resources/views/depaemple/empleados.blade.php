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
                <h3 class="card-title">:: Ingresar Empleado ::</h3>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('empleado') }}" method="post">
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
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre Empleado">
                    </div>
                    <div class="form-group">
                        <input type="text" name="apellido" class="form-control" placeholder="Apellido Empleado">
                    </div>
                    <div class="form-group">
                        <input type="text" name="puesto" class="form-control" placeholder="Puesto Empleado">
                    </div>
                    <div class="form-group">
                        <input type="text" name="salario" class="form-control" placeholder="Salario Empleado">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card col-md-12">
        <div class="card-header">
            <h3 class="card-title">:: Lista de Producto ::</h3>
        </div>
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
                        <th colspan="2"> Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($empleado as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombreDepa }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->apellido }}</td>
                            <td>{{ $item->puesto }}</td>
                            <td>{{ $item->salario }}</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Acciones">

                                  <form class="bono-form" action="{{ url('bono', $item->id) }}">
                                      @csrf
                                      <button class="btn btn-primary btn-sm bono-btn" type="submit"> BONO</button>
                                  </form>    

                                  <form class="delete-form" action="{{ url('empleado', $item->id) }}" method="post">
                                      @method('delete')
                                      @csrf
                                      <button class="btn btn-danger btn-sm delete-btn" type="submit">
                                          <i class="fas fa-trash"></i> Delete
                                      </button>
                                  </form>
                              </div>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
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
