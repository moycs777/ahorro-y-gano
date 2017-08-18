@extends('admin.layouts.app')

@section('headSection')
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Coupon</h1>    
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
                <h1>Edit Coupon</h1>
                <hr/>

                <h1>Coupon</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID.</th> <th>Store Id</th><th>Promotion Id</th><th>User Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $coupon->id }}</td> <td> {{ $coupon->store_id }} </td><td> {{ $coupon->promotion_id }} </td><td> {{ $coupon->user_id }} </td>
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




