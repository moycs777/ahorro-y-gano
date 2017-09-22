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
     Concursos
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
              {{-- expr --}}
              <div>
              @if (!empty($activa))
              @endif
               <a href="{{ route('competition.create') }}" class="btn btn-primary pull-left btn-sm">Crear concurso</a>
                
                <a href="{{ route('ranking') }}" class="btn btn-primary pull-left btn-sm">Tabla de puntos ( Ranking )</a>
              </div>
              <br>
              {{-- <td>suma : {{ $activa->puntos[0]->sum}}</td> --}}
            <h1>Concursos </h1>
            @if (empty($activa))
            @endif
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nro</th>
                <th>Concurso</th>
                <th>Activo</th>
                <th>Meta</th>
                <th>Finalizado</th>
                <th>Fecha limite</th>
                <th>Creado</th>
                <th>Puntos actuales</th>
                <th>Premio</th>
                <th>Porcentaje</th>

                <th>Ganador</th>
                <th>Puntos faltantes</th>
                
              </tr>
              </thead>
              <tbody>
              @if (! empty($competitions) )
                {{-- expr --}}
              @foreach ($competitions as $item)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>                    
                    <td>
                      @if($item->active == 0)
                        No                      
                      @endif
                      @if($item->active == 1)
                        Si                      
                      @endif
                    </td>
                    <td>{{ $item->goal }}</td>
                    <td>
                      @if($item->ended == 0)
                        No ha finalizado                     
                      @endif
                      @if($item->ended == 1)
                        Finalizado                      
                      @endif
                    </td>
                    <td>{{ $item->dead_line }}</td>
                    <td>{{ $item->created_at }}</td>
                    
                    @if($item->active == 1)
                      <td>{{ $activa->puntos[0]->sum}}</td>
                    @endif

                    @if($item->active == 0)
                      <td></td>
                    @endif


                    <td>
                    @if($item->active == 1)
                        
                        {{--  $premio = 0;
                         $premio = $item->goal * 0.1
                         $premio = ($premio * $item->reward) / 100; --}}
                        {{-- Ganancia en Euros --}}
                        {{  ( ($item->goal * 0.01) * $item->reward ) / 100 }} €
                      
                    @endif
                    <td>{{ $item->reward }} %</td>

                    @if($item->active == 0)
                      <td> {{ $item->winners }}</td>
                    @endif

                    @if($item->active == 1)
                      <td> {{ $item->winners }}</td>
                    @endif

                    @if($item->active == 1)
                      <td> {{ $item->goal - $activa->puntos[0]->sum }}</td>
                    @endif

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