@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Concurso
      <small>El premio se tomara del 1% de las ganacias de A&G</small>
    </h1>
     

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Informacion del Concurso</h3>
          </div>
          @include('includes.messages')
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{ route('competition.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="title">Nombre</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                </div>

                <div class="form-group">
                  <label for="subtitle">Meta en puntos</label>
                  <input type="number" class="form-control" id="goal" name="goal" placeholder="goal" min="1" required>
                </div>

                <div class="form-group">
                    <label for="subtitle">Recompenza (porcentaje)</label>
                    <input type="number" class="form-control" id="reward" name="reward" placeholder="Premio" min="1" max="90" required>
                </div>

                <div class="form-group {{ $errors->has('expires') ? 'has-error' : ''}}">
                    {!! Form::label('dead_line', 'Fecha Limite: ', ['class' => 'form-control']) !!}
                        {!! Form::date('dead_line', null, ['min' => $dt ]) !!}
                        {{-- <input type="date" name="dead_line" min="2017-09-14"> --}}
                        {!! $errors->first('dead_line', '<p class="help-block">:message</p>') !!}
                </div>

                @if ($activa == null)
                  <p>no hay concurso activo</p>
                  <input type="hidden" name="active" value="1">
                  <input type="hidden" name="ended" value="0">
                @else
                  <p>si hay concurso activo</p>
                  {{-- {{$activa}} --}}
                  <input type="hidden" name="active" value="0">
                  <input type="hidden" name="ended" value="0">
                  
                @endif
                
              </div>
              <div class="col-lg-6">
                  
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box">
             <div class="box-footer">
              <input type="submit" class="btn btn-primary" value="Guardar">
              {{-- <a href='{{ route('competition.index') }}' class="btn btn-warning">Concursos</a> --}}
            </div>
          </form>
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