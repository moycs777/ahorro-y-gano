@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<div id="app">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Tabla de puntuacion
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        
        {{-- <a class='col-lg-offset-5 btn btn-success' href="{{ route('invoice.generate', Auth::user()->id ) }}">Pagar</a> --}}
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          
        </div>
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <br>
            @if (!empty($activa))
              <td>suma : {{ $activa->puntos[0]->sum}}</td>
            @endif            
            
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div>
              @if (!empty($concurso))
                <p>Meta</p>{{ $concurso->goal }}
                <p>porcentaje de ganacia</p>{{ $concurso->reward }}
              @endif
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>                
                <th>Nro</th>
                <th>Concurso</th>
                <th>Activo</th>
                <th>Meta</th>
                <th>Creado</th>
                <th>Puntos actuales</th>
                <th>Premio</th>
                <th>Porcentaje</th>                
              </tr>
              </thead>
              <tbody>
              @foreach ($ganadores as $item)
                {{ $item }}
              @endforeach
              {{-- @if (! empty($ganadores) )
              @foreach ($ganadores as $item)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->active }}</td>
                    <td>{{ $item->goal }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $activa->puntos[0]->sum}}</td>
                    <td>{{ $item->reward }}</td>
                    <td>{{ $item->user }}</td>
                </tr>
              @endforeach
              @endif --}}
              </tbody>
              <tfoot>
              <tr>
                <th>Nro</th>            
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{-- <p>Debe pagar: {{ $total }} €</p> --}}        
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.js"></script>
<script>
  $(function () {
    
    $("#example1").DataTable( {
      "pageLength": 100
    });
    });
</script>
@endsection