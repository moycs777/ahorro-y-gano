@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Anuncio</h1>
    
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
            <h1>Edit Promotion</h1>
            <hr/>

            {!! Form::model($promotion, [
                'method' => 'PATCH',
                'url' => ['admin/promotion', $promotion->id],
                'class' => 'form-horizontal',
                'enctype' =>'multipart/form-data'
            ]) !!}

                <input type="hidden" id="precio" name="precio" value="{{$promotion->price_not_offert}}">
                <input type="hidden" id="tipo" value="{{$promotion->type}}">

                <div class="form-group {{ $errors->has('store') ? 'has-error' : ''}}">
                {!! Form::label('store', 'Store: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {{-- {!! Form::text('store', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                    <select class="form-control" data-placeholder="Tiendas"  name="store_id">
                      
                        <option value="{{ $promotion->store->id }}">{{ $promotion->store->name }}</option>
                      
                    </select>
                    {!! $errors->first('store', '<p class="help-block">:message</p>') !!}
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
                    {!! Form::number('price_not_offert', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('price_not_offert', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div id="price_with_offert" class="form-group {{ $errors->has('price_with_offert') ? 'has-error' : ''}}">
                {!! Form::label('price_with_offert', 'Price With Offert: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('price_with_offert', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                </div>
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
                    {!! Form::number('points', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('points', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div id="div_type" class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Type: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('type', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
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
<script src="{{  asset('admin/ckeditor/ckeditor.js') }}"></script>

<script>
  $(document).ready(function() {
    $(".select2").select2();

        console.log( "Promotion edit ready! de tipo " + $('#tipo').val());     
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        $(".select2").select2();

        if ($('#tipo').val() == 2) {
            $('#div_type').hide();
            $('#price_with_offert').hide();
            $('#price_with_offert').val(1);
        }

        $('#div_type').hide();
        precio = $('#precio').val();
        $('#price_with_offert').val(precio);

        $( "#points" ).focus(function() {
          var_min = $( "#price_not_offert" ).val();
          $( "#points" ).attr({"min" : var_min })
        });
        
  });
</script>
@endsection




