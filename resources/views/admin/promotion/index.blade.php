@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Anuncios</h1>
    
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
          <h1>Anuncio <a href="{{ url('admin/promotion/create') }}" class="btn btn-primary pull-right btn-sm">Agregar Anuncio</a></h1>
          <div class="table table-responsive">
              <table class="table table-bordered table-striped table-hover" id="tbladmin/promotion">
                  <thead>
                      <tr>
                          <th>ID</th><th>Store</th><th>Name</th><th>Description</th><th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>

                  @isset($promotion)
                  @foreach($promotion as $item)
                      <tr>
                          <td>{{ $item->id }}</td>
                          <td>{{ Auth::user()->name }}</td>
                          <td><a href="{{ url('admin/promotion', $item->id) }}">{{ $item->name }}</td><td>{{ $item->description }}</a></td>
                          <td>
                              @if (count($item->coupon) == 1)
                                 no se puede editar, porque hay descargas.
                              @endif
                              @if (count($item->coupon) == 0)
                                 <a href="{{ url('admin/promotion/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                                 {!! Form::open([
                                     'method'=>'DELETE',
                                     'url' => ['admin/promotion', $item->id],
                                     'style' => 'display:inline'
                                 ]) !!}
                                     {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                 {!! Form::close() !!}
                              @endif
                          </td>
                          <td>{{-- Storage::disk('local')->url($item->picture) --}}
                          <img class="img-responsive" WIDTH="50" HEIGHT="50" alt="" src="{{  url($item->picture)}}" />
                          </td>
                      </tr>
                  @endforeach
                  @endisset
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
        $('#tbladmin/promotion').DataTable({
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

