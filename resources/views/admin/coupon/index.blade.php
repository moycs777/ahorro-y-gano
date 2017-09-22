@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Listado de cupones 
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nro</th>
                <th>Codigo de Cupon</th>
                <th>Tienda</th>
                <th>Anuncio</th>
                <th>Cliente</th>
                <th>Creacion</th>
                <th>Aprobar</th>
                <th>Operaciones</th>
                <th>Estado</th>
                <th>Deuda</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($coupon as $item)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->store->name }}</td>
                  <td>{{ $item->promotion->name }}</td>
                  <td>{{ $item->user->email }}</td>
                  <td>{{ $item->created_at }}</td>
                  
                  @if($item->consolidated == 0)  
                    <form method="post" action="{{ route('cupon.reclaim') }}">
                      {{ csrf_field() }}
                      <td>
                        <input type="hidden" name="coupon_id" value="{{ $item->id }}">
                        <input type="number" name="points" min="{{ $item->points }}" value="{{ $item->points }}" >
                        <input type="submit" value="Activar">
                      {{-- <a href="{{ route('cupon.reclaim', $item->id) }}"><span class="glyphicon glyphicon-edit"></span></a> --}}</td> 
                      
                      
                    </form>
                  @endif
                  @if($item->consolidated == 1)  
                    <td>Aprobado<td>
                  @endif
                    {{-- <form id="delete-form-{{ $item->id }}" method="post" action="{{ route('coupon.destroy',$item->id) }}" style="display: none">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a href="" onclick="
                    if(confirm('Are you sure, You Want to delete this?'))
                        {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $item->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" ><span class="glyphicon glyphicon-trash"></span></a> --}}
                  </td>
                  <td>
                    @if( $item->consolidated < 1)
                    no aprobado
                    @endif
                    @if( $item->consolidated > 0)
                    aprobado
                    @endif
                  </td>
                  <td>
                    @if( $item->payed < 1)
                    no pagado
                    @endif
                    @if( $item->payed > 0)
                    pagado
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Nro</th>
                 <th>Tienda</th>
                 <th>Anuncio</th>
                 <th>Cliente</th>
                 <th>Creacion</th>
                 <th>Aprobar</th>
                 <th>Borrar</th>
                 <th>Estado</th>
                 <th>Deuda</th>

              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable( {
      "pageLength": 100
    });
  });
</script>
@endsection