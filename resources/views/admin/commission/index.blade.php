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
     Comisiones
    </h1>    
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <a class='col-lg-offset-5 btn btn-success' href="{{ route('debt.create') }}">Autorizar pago</a>
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Deuda por cupones</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nro</th>
                <th>Tienda</th>
                <th>Anuncio</th>
                <th>ID usuario</th>
                <th>Puntos</th>
                <th>Comision a pagar</th>
                <th>blank</th>
              </tr>
              </thead>
              <tbody>
              @php
                $pago = 0;
              @endphp
              @foreach ($debts as $item)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $item->store->name }}</td>
                  <td>{{ $item->promotion->name }}</td>
                  <td>{{ $item->user->email }}</td>
                  <td>{{ $item->points }}</td>
                  <td>
                    @php
                      $comision = ($item->points * 1)/100;
                      $pago += $comision;
                    @endphp
                    {{ $comision }} €
                  </td>
                  <td>                    
                  </td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Nro</th>
                <th>Tienda</th>
                <th>Anuncio</th>
                <th>ID usuario</th>
                <th>Puntos</th>
                <th>Comision a pagar</th>
                <th>blank</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <p>Debe pagar: {{ $pago }} €</p>
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