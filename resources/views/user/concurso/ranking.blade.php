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
      
        <div class="row">
            <div class="box-body">
              <div class="box">
                  <a href="{{ route('user.beneficiario') }}"><i class="fa fa-circle-o"></i> Regalar puntos</a>
                <div class="box-header">
                  <h3 class="box-title">Tabla del Concurso </h3>
                </div>
                
                @if (!empty($concurso))
                <div class="col-md-12">

                  <div class="col-md-3">
                    <h4>Concurso</h4>{{ $concurso->name }}
                  </div>
                  <div class="col-md-3">
                    <h4>Meta</h4>{{ $concurso->goal }}
                  </div>
                  <div class="col-md-3">
                    <h4>Ganacia </h4><p>{{  ( $concurso->goal * 0.01 ) / $concurso->reward  }} €</p>
                  </div>
                  <div class="col-md-3">
                    <h4>Puntos acumulados </h4><p>{{ $concurso->puntos[0]->sum }}</p>
                  </div> 
  
                </div>
                @endif
                @if (empty($concurso))
                  <div class="col-md-4">
                    <h4>No Hay Concurso aun!</h4>{{ $concurso->name }}
                  </div>
                @endif
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nro</th>
                      <th>Concurso</th>
                      <th>Activo</th>
                      <th>Meta</th>
                      <th>Creado</th>
                      <th>Puntos actuales</th>
                      <th>Premio</th>
                      <th>Porcentaje</th>
                      <th>Ganador</th>
                      <th>Puntos faltantes</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if (! empty($ganadores) )
                      @foreach ($ganadores as $item)
                        <tr>
                          <td> {{ $loop->index + 1 }} </td>
                          <td>{{ $item->user->email}}</td>
                          <td>{{ $item->sum}}</td>
                        </tr>
                      @endforeach
                      @endif
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