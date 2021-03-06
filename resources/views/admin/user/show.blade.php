@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modulo de Usuarios
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        @if(Auth::user()->level ==1 or Auth::user()->level < 3)        
          <a class='col-lg-offset-5 btn btn-success' href="{{ route('user.create') }}">Crear nuevo usuario</a>
        @endif
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Usuarios administradores</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No</th>
                <th>Nombre</th>
                <th>email</th>
                <th>Cargo</th>
                <th>Creado</th>
                <th>Editar</th>
                <th>Borrar</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($admins as $admin)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>
                    @if ($admin->level == 1)
                      Administrador
                    @endif
                    @if ($admin->level == 2)
                      Delegado
                    @endif
                    @if ($admin->level == 3)
                      Comercial
                    @endif
                  </td>
                  <td>{{ $admin->created_at }}</td>
                  <td><a href="{{ route('user.edit',$admin->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                  <td>
                    <form id="delete-form-{{ $admin->id }}" method="post" action="{{ route('user.destroy',$admin->id) }}" style="display: none">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a href="" onclick="
                    if(confirm('Are you sure, You Want to delete this?'))
                        {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $admin->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" ><span class="glyphicon glyphicon-trash"></span></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Sub Title</th>
                <th>Slug</th>
                <th>Creatd At</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection