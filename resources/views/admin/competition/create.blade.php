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
                    <label for="subtitle">Recompenza</label>
                    <input type="number" class="form-control" id="reward" name="reward" placeholder="Premio" min="1" max="50" required>
                </div>
                
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