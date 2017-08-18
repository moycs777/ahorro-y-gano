@extends('admin.layouts.app')

@section('headSection')
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Clasification</h1>    
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
             
              
                {{-- start stub crud  --}}
                <h1>Edit Clasification</h1>
                <hr/>

                <h1>Clasification</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID.</th> <th>Name</th><th>Doubt Percentage</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $clasification->id }}</td> <td> {{ $clasification->name }} </td><td> {{ $clasification->doubt_percentage }} </td><td> {{ $clasification->status }} </td>
                            </tr>
                        </tbody>    
                    </table>
                </div>         

            </div>
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
@endsection




