@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Crear Coupon</h1>
    
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
          {!! Form::open(['url' => 'admin/coupon', 'class' => 'form-horizontal']) !!}

                      <div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
                {!! Form::label('store_id', 'Store Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('store_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('promotion_id') ? 'has-error' : ''}}">
                {!! Form::label('promotion_id', 'Promotion Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('promotion_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('promotion_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('consolidated') ? 'has-error' : ''}}">
                {!! Form::label('consolidated', 'Consolidated: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('consolidated', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('consolidated', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('consolidated', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('payed') ? 'has-error' : ''}}">
                {!! Form::label('payed', 'Payed: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('payed', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('payed', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('payed', '<p class="help-block">:message</p>') !!}
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
<script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2();
  });
</script>
@endsection