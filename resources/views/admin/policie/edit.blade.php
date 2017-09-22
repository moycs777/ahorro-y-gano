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
      Politicas
      <small>Advanced form element</small>
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Lugar de uso</h3>
          </div>
          @include('includes.messages')
          <!-- /.box-header -->
          <!-- form start -->
          {{-- <form role="form" action="{{ route('policies.update',$policie->id) }}" method="PATCH" enctype="multipart/form-data"> --}}
            {{-- {{ csrf_field() }} --}}
            {!! Form::model($policie, [
                            'method' => 'PATCH',
                            'url' => ['admin/policies', $policie->id],
                            'class' => 'form-horizontal'
                        ]) !!}
            
            <div class="box-body">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="title">Lugar de uso</label>
                  <input type="text" class="form-control" id="use" name="use" placeholder="Politicas etc." value="{{ $policie->use }}" disabled>
                </div>

              </div>
            </div> 
            <!-- /.box-body -->
            
            <div class="box">
             <div class="box-header">
               <h3 class="box-title">Escribe aqui el contenido
               </h3>
               <!-- tools box -->
               <div class="pull-right box-tools">
               </div>
                 <!-- /. tools -->
               </div>
               <!-- /.box-header -->
               <div class="box-body pad">
                 <textarea name="body" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="editor1" >{!! $policie->body !!}</textarea>
               </div>
             </div>

             <div class="box-footer">
              <input type="submit" value="Editar" class="btn btn-primary">
            </div>
          </form>
        </div>
        {!! Form::close() !!}
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