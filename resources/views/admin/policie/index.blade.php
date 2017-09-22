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
     Politicas
    </h1>    
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><a href="{{ url('admin/policies/create') }}" class="btn btn-primary pull-right btn-sm">Crear Politica</a></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nro</th>
                <th>Uso</th>
                <th>Contenido</th>
                <th>Creacion</th>
                <th></th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @if (!empty($policies))
                @foreach ($policies as $item)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td><a href="{{ url('admin/policies', $item->id . '/edit' ) }}">{{ $item->use }}</a></td>
                    <td>{!! $item->body !!}</td>
                    <td>{{ $item->created_at }}</td>   
                    <td>
                      
                   
                  </tr>
                @endforeach
              @endif
              </tbody>
             
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
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
                                    
          