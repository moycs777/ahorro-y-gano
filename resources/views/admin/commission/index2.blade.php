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
       Comisiones
    </h1>    
  </section>
  @php
    $total = 0;
    $deuda = 0;
  @endphp
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
            {{-- <h3 class="box-title">Marcar/Desmarcar Todos</h3> --}}
           {{--  <br>
            <input type="button" id="select_all"    
                   /> --}}
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @if ($commision !=null)
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>                
                <th></th>
                <th>Nro</th>
                <th>Delegado</th>
                <th>Anuncio</th>
                <th>Pagado</th>
                <th>Puntos</th>
                <th>Comision a pagar</th>
                <th>fecha de pago</th>
                <th>tiempo en el negocio (años)</th>
              </tr>
              </thead>
              <tbody>
              
                {{-- expr --}}
              @foreach ($commision as $item)
                <tr>
                  <th>
                    {{-- Checkboxes --}}
                    @if ($item->payed ==0)
                      @php
                        $price = $item->price;
                      @endphp
                      <input type="checkbox" 
                          id="{{$item->id}}"
                          value="{{$price}}"
                          class="myCheckbox"                         
                      >
                    @endif
                  </th>

                  <td>{{-- numero --}}{{ $loop->index + 1 }}</td>
                  <td>{{-- nombre de delegado --}}{{ $admin->name }}</td>
                  <td>{{-- numero de cupon --}}{{ $item->coupon_id }}</td>
                  
                  <td>
                    {{-- booleano para estado del pago --}}
                    @if ($item->payed ==1)
                      <p class="text-primary">Pagado</p>
                      @php
                        $comision = $item->price;
                        $deuda += $comision;
                      @endphp
                    @else
                      <p class="text-danger">En deuda</p>
                      @php
                        $comision = $item->price;
                        $total += $comision;
                      @endphp
                    @endif
                  </td>
                  
                  <td>{{-- variable de puntos --}}</td>

                  <td>
                    {{-- @php
                      $comision = ($item->points * 0.01);
                      $total += $comision;
                    @endphp --}}
                    {{ $item->price }} €
                  </td> 

                  <td>
                    @if (!$item->payed_at == null)
                      {{ $item->payed_at }}
                    @else
                      No Pagado
                    @endif
                  </td> 

                  <td>{{ $item->age }} años</td>  
                             
                </tr>
              @endforeach

              </tbody>
              <tfoot>
              <tr>
                
              </tr>
              </tfoot>
            </table>
            @endif

          </div>

          {{-- div para hijos --}}
          {{-- 
            
            @foreach ($item as $element)
              {{$element->id}}
            @endforeach
           --}}
          <div>
            aki iran los hijos
            @if ($commision_hijos !=null)
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>                
                <th></th>
                <th>Nro</th>
                <th>Delegado</th>
                <th>Anuncio</th>
                <th>Pagado</th>
                <th>Puntos</th>
                <th>Comision a pagar</th>
                <th>fecha de pago</th>
                <th>tiempo en el negocio (años)</th>
              </tr>
              </thead>
              <tbody>
              
                {{-- expr --}}
              @foreach ($commision_hijos as $item)
                <tr>
                  <th>
                    {{-- Checkboxes --}}
                    @if ($item->payed ==0)
                      @php
                        $price_hijos = $item->price;
                      @endphp
                      <input type="checkbox" 
                          id="{{$item->id}}"
                          value="{{$price_hijos}}"
                          class="myCheckbox"                         
                      >
                    @endif
                  </th>

                  <td>{{-- numero --}}{{ $loop->index + 1 }}</td>
                  <td>{{-- nombre de delegado --}}{{ $admin->name }}</td>
                  <td>{{-- numero de cupon --}}{{ $item->coupon_id }}</td>
                  
                  <td>
                    {{-- booleano para estado del pago --}}
                    @if ($item->payed ==1)
                      <p class="text-primary">Pagado</p>
                      @php
                        $comision_hijos = $item->price;
                        $deuda += $comision_hijos;
                      @endphp
                    @else
                      <p class="text-danger">En deuda</p>
                      @php
                        $comision_hijos = $item->price;
                        $total_hijos += $comision_hijos;
                      @endphp
                    @endif
                  </td>
                  
                  <td>{{-- variable de puntos --}}</td>

                  <td>
                    {{-- @php
                      $comision = ($item->points * 0.01);
                      $total += $comision;
                    @endphp --}}
                    {{ $item->price }} €
                  </td> 

                  <td>
                    @if (!$item->payed_at == null)
                      {{ $item->payed_at }}
                    @else
                      No Pagado
                    @endif
                  </td> 

                  <td>{{ $item->age }} años</td>  
                             
                </tr>
              @endforeach

              </tbody>
              <tfoot>
              <tr>
                
              </tr>
              </tfoot>
            </table>
            @endif
          </div>
          {{-- Fin del div para hijos --}}

          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <p class="text-primary">Cancelado: {{ $deuda }} €</p>
        <p class="text-danger">Total adeudado: {{ $total }} €</p>
        <hr>
        <h4>Efectuar pago</h4>
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