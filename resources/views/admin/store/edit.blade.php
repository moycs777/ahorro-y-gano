@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/store.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Tienda</h1>
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Infomacion</h3>
          </div>
          @include('includes.messages')
          <!-- /.box-header -->
          <!-- form start -->
          
          {{-- start stub crud  --}}
            <h1>Editar Tienda</h1>
            {{-- {{ $store }} --}}
            <hr/>

            {!! Form::model($store, [
                'method' => 'PATCH',
                'url' => ['admin/store', $store->id],
                'class' => 'form-horizontal'
            ]) !!}
            
            <input type="hidden" name="auth_id" value="{{ $store->auth_id }}">
            <input type="hidden" name="admin_id" value="{{ $store->admin_id }}">
            <input type="hidden" name="location" value="{{ Auth::id() }}">
            <input type="hidden" name="url" id="url" value="{{route('ciudades')}}">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
            </div>
            <div class="form-group {{ $errors->has('nif_cif') ? 'has-error' : ''}}">
                {!! Form::label('nif_cif', 'Nif Cif: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nif_cif', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('nif_cif', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
         
            <div class="form-group {{ $errors->has('store') ? 'has-error' : ''}}">
              {!! Form::label('clasification_id', 'Tipo de tienda: ', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-6">
                  {{-- {!! Form::text('store', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                  <select class="form-control" data-placeholder="Categorias"  name="clasification_id">
                    @foreach ($clasifications as $clasification)
                      <option value="{{ $clasification->id }}">{{ $clasification->name }}</option>
                    @endforeach
                  </select>
                  {!! $errors->first('clasification', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            {{-- estado --}}
            <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                {!! Form::label('state', 'Provincia: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {{-- {!! Form::text('state', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('state', '<p class="help-block">:message</p>') !!} --}}
                    <select id="state" name="state" class="js-example-basic-single form-control" required>
                     <option>Seleccione</option>
                      @foreach ($states as $state)
                        <option value="{{ $state->id_provincia }}" >{{ $state->provincia }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            {{-- ciudad --}}
            <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
              {!! Form::label('city', 'Ciudad: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {{-- {!! Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!} --}}
                  <select class="form-control js-example-basic-single" id="categoria_hijo" name="city" required>
                     <option></option>
                 </select>
                </div>               
            </div> 

            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                {!! Form::label('address', 'Address: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('billing_address') ? 'has-error' : ''}}">
                {!! Form::label('billing_address', 'Billing Address: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('billing_address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('billing_address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            
            <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
                {!! Form::label('location', 'Location: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('zip') ? 'has-error' : ''}}">
                {!! Form::label('zip', 'Zip: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone_1') ? 'has-error' : ''}}">
                {!! Form::label('phone_1', 'Phone 1: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone_1', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('phone_1', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone_2') ? 'has-error' : ''}}">
                {!! Form::label('phone_2', 'Phone 2: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone_2', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('phone_2', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {{-- {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                    <input type="text" name="email" class="form-control" value="{{ $store->email }}" disabled>
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('contact') ? 'has-error' : ''}}">
                {!! Form::label('contact', 'Contact: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('contact', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('contact', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('debt_level') ? 'has-error' : ''}}">
                {!! Form::label('debt_level', 'Debt Level: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('debt_level', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('debt_level', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', 'Status: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('status', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('status', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

          {{-- End stub crud  --}}
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
<script>
  var url_home_ajax = document.getElementById('url').value;
  //console.log(url_home_ajax);

  $(function () {
    $(".select2").select2();
    $(".js-example-basic-single").select2();

    console.log('creacion de tiendas 0.1.2');
        /*  --------------------------*/
        //enviar categoria_hijos al back
        $('#state').on('change',function () {
            var id = $('#state option:selected').val();
            console.log(id);

            $.ajax({
              url: url_home_ajax + '/' + id
            })
            .done(function( data ) {
            
              $('#categoria_hijo').html('');
              data.forEach(function(element, i, a) {
                  console.log("elemento "+element.nombre);
                  console.log("id_provincia: "+element.id_provincia);
                  console.log("i: "+i);
                  $('#categoria_hijo').append('<option value= "'+ element.id_municipio +'">'   + element.nombre +  '</option>');
                  
              });
              
            });
            
        });
    
  });
</script>
@endsection




