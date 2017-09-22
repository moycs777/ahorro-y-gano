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
     Cupones Adeudados    
      
    </h1>
    
  </section>
  
  @php
    $total = 0;
  @endphp

  <!-- Main content -->
  <section class="content">
    
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        
        {{-- <a class='col-lg-offset-5 btn btn-success' href="{{ route('invoice.generate', Auth::user()->id ) }}">Pagar</a> --}}
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
            {{-- <h3 class="box-title">Marcar/Desmarcar Todos</h3> --}}
            {{-- <br>
            <input type="button" id="select_all"    
                   /> --}}
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
              
              @foreach ($debts as $item)
                <tr>
                  {{-- <th>
                    @php
                      $price = ($item->points * 0.01);
                    @endphp
                    <input type="checkbox" 
                        id="{{$item->id}}"
                        value="{{$price}}"
                        class="myCheckbox" 
                        
                    >
                  </th> --}}
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $item->store->name }}</td>
                  <td>{{ $item->promotion->name }}</td>
                  <td>{{ $item->user->email }}</td>
                  <td>{{ $item->points }}</td>
                  <td>
                    @php
                      $comision = ($item->points * 0.01);
                      $total += $comision;
                    @endphp
                    {{ $comision }} €
                  </td>
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
        <p>Total a pagar: </p>{{ $total }}
        {{-- <p>Debe pagar: {{ $total }} €</p> --}}
        {{-- <form action="{{   route('invoice.generate') }}" method="post" id="invoice">
          Comentario: <input type="text" name="comment"><br>
          <input type="hidden" name="auth_id" value="{{  Auth::user()->id }}">
          <input type="hidden" name="total" value="" id="total">
          <input type="hidden" name="cupones[]" value="" id="cupones">
          <label for="Total">Total de deuda : </label><br>
          {{ $total }} <br>
          <label for="Total">(esta funcion esta en fase beta) Total a pagar :</label>
          <label for="myalue" style="vertical-align: middle"></label>
          <br>
          <input type="submit" value="pagar" class="class='btn btn-primary col-lg-offset-5'">
          
           {{ csrf_field() }}
        </form> --}}
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

    console.log("invoice 0.43\n");
    resultado = 0;
    cupones = [];
   
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
        id = $(this).attr('id');
        if($(this).is(":checked")){
            //alert("Checkbox is checked.");
                        
        }
        else if($(this).is(":not(:checked)")){
            //alert("Checkbox is unchecked.");
        }
        valor1 = $(this).attr('value');
        if(this.checked) ope = "+"
        if(!this.checked) ope = "-"
        console.log("monto: " + valor1 + ' id: ' + id + ' operacion: ' + ope);
        //console.log("...\n");
        result(valor1,ope,id);
    });
    
    function result(valor1, ope,id){

        if (ope == "+") {
            resultado = parseFloat(valor1) + resultado;
            $("#total").val(resultado); 
            cupones.push(id);
            $("#cupones").val(id);   
            $("label[for='myalue']").html(resultado);        
            console.log("cupones. " + cupones + "1 valor1: " + valor1 + ' ope: ' + ope + ' resultado: ' + resultado);


            var id = id;
            $('#invoice').append('<input type="hidden"  name="cupones_id['+id+']" value="'+id+'">');
            $('input[type="hidden"]').trigger('change')
              
        }
        if (ope == "-") {
            resultado =  resultado - parseFloat(valor1);            
            $("#total").val(resultado);            
            console.log("id: " + id + "2 valor1: " + valor1 + ' ope: ' + ope + ' resultado: ' + resultado);

            jQuery("label[for='myalue']").html(resultado);

            id_elim = $('input[type="hidden"][value='+id+']').val();
            $('input[type="hidden"][value='+id+']').remove();
        }
    }

    $('#select_all').click(function() {
        console.log("seleccionar todo");
        
        $('input[type="checkbox"]').each(function(i, o){ 
          $('input[type="checkbox"]')[i].click();
        });
        
    });
    
  })

 

</script>
@endsection