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
     Cobor a las Tiendas
      
    </h1>
    
  </section>
  
 {{--  @php
    $total = 0;
  @endphp --}}

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
             @foreach ($stores as $item)
                  <a href="{{ route('listar.tienda', $item->id) }}">
                    <p>{{ $item->name }}</p>
                  </a>
              @endforeach
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            
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