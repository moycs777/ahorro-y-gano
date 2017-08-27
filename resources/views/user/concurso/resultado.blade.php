@extends('user/app')

@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
<!-- Post Content -->
<div id="fb-root"></div>

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
                      
                    <h4>Resultados</h4>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Email</th>
                          <th>puntos</th>
                          <th>Disponible para ayudar</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $item)
                          <tr>
                            <td>{{ $item->email }}</td>
                            {{-- @if($alerta == true)  --}} 
                            
                              <form method="post" action="{{ route('regalar') }}">
                                {{ csrf_field() }}
                                <td>
                                  <input type="hidden" name="regalador_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" name="receptor_id" value="{{ $item->id }}">
                                  <input type="number" name="points" min="1" max="{{ $sum->sum }}" 
                                    value="1" >
                                  <input type="submit" value="Regalar">
                               </td> 
                                
                                
                              </form>
                            {{-- @endif --}}
                            
                         
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          

                        </tr>
                        </tfoot>
                      </table>
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