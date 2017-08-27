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
                <div class="box-header">
                  <h3 class="box-title">Regala punto, ayuda a un amigo y recibe beneficios! </h3>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- search form -->
                    <div class="col-md-6">
                      
                    <h4>Busca por nombre, codigo de usuario o email</h4>
                      <form class="navbar-form navbar-center" role="search" action="{{route('busqueda')}}" method="get">
                          {{ csrf_field() }}
                          <div class="input-group">
                          <input type="text" class="form-control" placeholder="Buscar" name="buscar">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                              </button>
                            </span>
                          </div>
                      </form>
                                <!--/.nav-collapse -->
                    <!-- /.search form -->
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