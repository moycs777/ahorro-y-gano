@extends('user/app')

@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
<!-- Post Content -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=455618938154843";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<article>
    <div class="container">
        @php
          $points = 0;
        @endphp
        <div class="row">
            <div class="box-body">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">El Concurso actual es {{ $competition->name }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nombre:</th>
                      <th>Meta en puntos:</th>
                      <th>Recompensa</th>
                      <th>Fecha de inicio</th>
                      <th>Puntos Acumulados</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                      <tr>
                        <td>{{ $competition->name }}</td>
                        <td>{{ $competition->goal }}</td>
                       {{--  @if($item->consolidated == 0)  
                          <td>En espera
                          </td>
                          
                        @endif
                        @if($item->consolidated == 1)  
                          <td>Aprobado</td>
                          @php
                            $points += $item->points ;
                          @endphp
                        @endif --}}
                        <td>{{ $competition->reward }}</td>
                        <td>{{ $competition->created_at }}</td>
                        
                      </tr>
                      
                    </tbody>
                    <tfoot>
                    {{-- <tr>
                      <th>Nro</th>
                      <th>Anuncio</th>
                      <th>Tienda</th>
                      <th></th>
                      <th>Estado</th>
                      <th>Puntos</th>
                      <th>Fecha de descarga</th>
                    </tr> --}}
                    </tfoot>
                  </table>
                </div>

                {{-- <p>Puntos acumulados: {{  $points }}</p> --}}
                    
                <!-- /.box-body -->
              </div>
            </div>

        </div>
    </div>
</article>

<hr>
@endsection
@section('footer')
<script src="{{ asset('user/js/prism.js') }}"></script>
@endsection