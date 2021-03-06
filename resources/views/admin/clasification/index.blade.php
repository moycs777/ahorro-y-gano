@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
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
          <h1>Clasification <a href="{{ url('admin/clasification/create') }}" class="btn btn-primary pull-right btn-sm">Add New Clasification</a></h1>
          <div class="table table-responsive">
              <table class="table table-bordered table-striped table-hover" id="tbladmin/clasification">
                  <thead>
                      <tr>
                          <th>ID</th><th>Name</th><th>Doubt Percentage</th><th>Puntaje minimo</th><th>Status</th><th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($clasification as $item)
                      <tr>
                          <td>{{ $item->id }}</td>
                          <td><a href="{{ url('admin/clasification', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->doubt_percentage }}</td><td>{{ $item->min_points }}</td><td>{{ $item->status }}</td>
                          <td>
                              <a href="{{ url('admin/clasification/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                              {!! Form::open([
                                  'method'=>'DELETE',
                                  'url' => ['admin/clasification', $item->id],
                                  'style' => 'display:inline'
                              ]) !!}
                                  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                              {!! Form::close() !!}
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#tbladmin/clasification').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection

{{--  --}}

