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
     Anuncios Pagados
      
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
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
            <h3 class="box-title">Pagados</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="{{ route('invoice.store') }}">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                
                <th>Nro</th>
                <th>Tienda</th>
                <th>Anuncio</th>
                <th>ID usuario</th>
                <th>Puntos</th>
                <th>Pagado</th>
                <th>Anuncio</th>
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
                  {{-- <a href="{{ route('debt.edit',$item->id) }}"><span class="glyphicon glyphicon-edit"></span></a> --}}</td>
                  <td>
                    <div class="asd"><img class="img-responsive" WIDTH="50" HEIGHT="50" alt="{{ $item->promotion->name }}" src="{{  url($item->promotion->picture)}}" />
                    </div>
                  </td>

                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <p>Ha pagado: {{ $pago }} €</p>
        <input type="submit" value="generar factura">
        </form>

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
    console.log("invoice 0.3\n");
    resultado = 0;
   
    /*$( "input[type=checkbox]" ).on( "click", function (){
        valor1 = $(this).attr('value');
        id = $(this).attr('id');
        if(this.checked) ope = "+"
        if(!this.checked) ope = "-"
        console.log("monto: " + valor1 + ' id: ' + id + ' operacion: ' + ope);
        //console.log("...\n");
        result(valor1,ope);

    });*/

    $('input[type="checkbox"]').click(function(){
        if($(this).is(":checked")){
            //alert("Checkbox is checked.");
        }
        else if($(this).is(":not(:checked)")){
            //alert("Checkbox is unchecked.");
        }
        valor1 = $(this).attr('value');
        id = $(this).attr('id');
        if(this.checked) ope = "+"
        if(!this.checked) ope = "-"
        console.log("monto: " + valor1 + ' id: ' + id + ' operacion: ' + ope);
        //console.log("...\n");
        result(valor1,ope);
    });
    
    function result(valor1, ope){

        if (ope == "+") {
            resultado = parseFloat(valor1) + resultado;            
            console.log("1 valor1: " + valor1 + ' ope: ' + ope + ' resultado: ' + resultado);
        }
        if (ope == "-") {
            resultado =  resultado - parseFloat(valor1);            
            console.log("2 valor1: " + valor1 + ' ope: ' + ope + ' resultado: ' + resultado);
        }
    }
    
  })
</script>
@endsection