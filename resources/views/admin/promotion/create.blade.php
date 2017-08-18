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
    <h1>Crear Anuncio as</h1>
    
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
            <div class="form-group {{ $errors->has('price_with_offert') ? 'has-error' : ''}}">
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
            <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Type: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                  {{ Form::select('type', [1, 2], ['class' => 'form-control', 'required' => 'required']) }}
                    {{-- {!! Form::number('type', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
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
      console.log( "ready!" );
      //alert("asd");
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
      $(".select2").select2();
  });
</script>
@endsection