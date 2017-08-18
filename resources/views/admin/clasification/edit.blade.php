@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@if(Auth::user()->level ==1)
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Crear Clasification</h1>
    
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
            <h1>Edit Clasification</h1>
            <hr/>

            {!! Form::model($clasification, [
                'method' => 'PATCH',
                'url' => ['admin/clasification', $clasification->id],
                'class' => 'form-horizontal'
            ]) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('doubt_percentage') ? 'has-error' : ''}}">
                {!! Form::label('doubt_percentage', 'Nivel de deuda: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {{-- {!! Form::number('doubt_percentage', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                    <input class="form-control" type="number" step="0.01" name="doubt_percentage" value="{{ $clasification->doubt_percentage }}">

                    {!! $errors->first('doubt_percentage', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('doubt_percentage') ? 'has-error' : ''}}">
                {!! Form::label('min_points', 'Porcentaje de Puntaje minimo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {{-- {!! Form::number('min_points', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                    <input class="form-control" type="number" step="0.01" name="min_points" min="10" max="100">                  
                    {!! $errors->first('min_points', '<p class="help-block">:message</p>') !!}
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
@endif

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




