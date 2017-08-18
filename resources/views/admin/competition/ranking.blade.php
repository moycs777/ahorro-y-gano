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

            @if (!empty($concurso))
            <div class="col-md-10">
              
              <div class="col-md-4">
                <h4>Concurso</h4>{{ $concurso->name }}
              </div>
              <div class="col-md-4">
                <h4>Meta</h4>{{ $concurso->goal }}
              </div>
              <div class="col-md-4">
                <h4>Ganacia </h4><p>{{  ( $concurso->goal * 0.01 ) / $concurso->reward  }} €</p>
                 
              </div> 

            </div>
            @endif

            @if (!empty($activa))
              <td>suma : {{ $activa->puntos[0]->sum}}</td>
            @endif            
            
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {{-- <div>
              @if (!empty($concurso))
                
                
              @endif
            </div> --}}
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>                
                <th>Posicion</th>
                <th>Usuario</th>
                <th>Puntos Acumulados</th>
                               
              </tr>
              </thead>
              <tbody>
             {{--  @foreach ($ganadores as $item)
                {{ $item }}
              @endforeach --}}
              @if (! empty($ganadores) )
              @foreach ($ganadores as $item)
                <tr>
                  <td>
                      {{ $loop->index + 1 }}
                  </td>
                  <td>{{ $item->user->email}}</td>
                  <td>{{ $item->sum}}</td>
                  
              
                </tr>
              @endforeach
              @endif
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