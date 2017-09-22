@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">



@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Crear Anuncio</h1>
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Ofertas</h3>
          </div>
          @include('includes.messages')
          <!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['url' => 'admin/promotion', 'class' => 'form-horizontal', 'enctype' =>'multipart/form-data']) !!}
            
                <input type="hidden" name="store_id"  value="{{ $store[0]['id']  }}">

                <div class="form-group {{ $errors->has('store') ? 'has-error' : ''}}">
                  {!! Form::label('store', 'Store: ', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-6">
                      {{-- {!! Form::text('store', Auth::user()->name, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                      <option value="{{ $store[0]['id'] }}" name="store_id" class = "form-control">{{ $store[0]['name'] }}</option>
                      {{-- <select class="form-control" data-placeholder="Tiendas"  name="store_id">
                        @foreach ($stores as $store)
                          <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                      </select> --}}
                      {!! $errors->first('store', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

            <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Type: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                  {{-- {{ Form::select('Tipo de Anuncio', ['Anuncio con oferta', 'Anuncio sin oferta'], ['id' => 'type', 'class' => 'form-control', 'required' => 'required']) }} --}}
                  <select name="type" id="type" required>
                    <option value="1">Anuncio con oferta</option>
                    <option value="2">Sin oferta</option>
                  </select>
                    {{-- {!! Form::number('type', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('price_not_offert') ? 'has-error' : ''}}">
                {!! Form::label('price_not_offert', 'Price Not Offert: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('price_not_offert', null, ['id' => 'price_not_offert', 'class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('price_not_offert', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div id="div_type" class="form-group {{ $errors->has('price_with_offert') ? 'has-error' : ''}}">
                {!! Form::label('price_with_offert', 'Price With Offert: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('price_with_offert', null, ['id' => 'price_with_offert', 'class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('price_with_offert', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
                {!! Form::label('picture', 'Picture: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('file', null, ['class' => 'form-control', 'required' => 'required']) !!} 
                    {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            

            <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
                {!! Form::label('location', 'Location: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
                    <input type="text" id="search"> <input type="button" value="Buscar Dirección" onClick="mapa.getCoords()">
                    <p id="coordenadas"></p>
                </div>
            </div>

            <div class="form-group">
              
              
            </div>

            <div class="form-group {{ $errors->has('expires') ? 'has-error' : ''}}">
                {!! Form::label('expires', 'Expires: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('expires', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('expires', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('points') ? 'has-error' : ''}}">
                {!! Form::label('points', 'Points: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('points', null, ['id' => 'points', 'class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('points', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

          <div class="form-group">
              <div class="col-sm-offset-3 col-sm-3">
                  {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
              </div>
          </div>
          {!! Form::close() !!}
        </div>
        <!-- /.box -->

        
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{  asset('admin/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script type="text/javascript">
   
  $(function() {
      console.log( "testing geo Promotion ready!" );     
      //bootstrap WYSIHTML5 - text editor
      /*$(".textarea").wysihtml5();*/
      $(".select2").select2();

      //sin oferta
      $( "#price_not_offert" ).focusout(function() {
          console.log('minimo de puntos: ' +  $( "#price_not_offert" ).val());
          var_min = $( "#price_not_offert" ).val();
          $( "#points" ).attr({"min" : var_min })
      })

      //con oferta
      $( "#price_with_offert" ).focusout(function() {
          var_max = $( "#price_not_offert" ).val();
          $( "#price_with_offert" ).attr({"max" : var_max })
      })

      $( "#points" ).focus(function() {
        var_min = $( "#price_not_offert" ).val();
        $( "#points" ).attr({"min" : var_min })
      });

      $('#type').on('change',function () {
          var var_type = $('#type').val();
          console.log(var_type);  
          if (var_type == 2) {
            console.log('ocultaos el precio con oferta');
            $('#div_type').hide();
            $('#price_with_offert').val(1);
          }

          if (var_type == 1) {
            console.log('ocultaos el precio con oferta');
            $('#div_type').show();
          }       
          
      });

  });
</script>

{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js"></script> --}}
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOxkBTkGPJHTZk-LFrN2gdinwYDOz1F80&callback=initMap"
  type="text/javascript"></script>

<script>

mapa = {
 map : false, 
 marker : false,

 initMap : function() {
 
 // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.
 
 mapa.map = new google.maps.Map(document.getElementById('mapa'), {
   center: {lat: 43.2686751, lng: -2.9340005},
   scrollwheel: false,
   zoom: 14,
   zoomControl: true,
   rotateControl : false,
   mapTypeControl: true,
   streetViewControl: false,
 });
 
 // Creamos el marcador
 mapa.marker = new google.maps.Marker({
 position: {lat: 43.2686751, lng: -2.9340005},
 draggable: true 
 });
 
 // Le asignamos el mapa a los marcadores.
  mapa.marker.setMap(mapa.map);
 
 },

// función que se ejecuta al pulsar el botón buscar dirección
getCoords : function()
{
  // Creamos el objeto geodecoder
 var geocoder = new google.maps.Geocoder();
 
 address = document.getElementById('search').value;
 if(address!='')
 {
  // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
 geocoder.geocode({ 'address': address}, function(results, status)  
 {
   if (status == 'OK')
   {
// Mostramos las coordenadas obtenidas en el p con id coordenadas
   document.getElementById("coordenadas").innerHTML='Coordenadas:   '+results[0].geometry.location.lat()+', '+results[0].geometry.location.lng();
// Posicionamos el marcador en las coordenadas obtenidas
   mapa.marker.setPosition(results[0].geometry.location);
// Centramos el mapa en las coordenadas obtenidas
   mapa.map.setCenter(mapa.marker.getPosition());
   agendaForm.showMapaEventForm();
   }
  });
 }
 }
}
    

</script>

@endsection