@extends('user/appo')

@section('bg-img',asset('user/img/politicas.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
	<!-- Main Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				<h3>Mensaje</h3>
				<div class="box-body">
				  <table id="example1" class="table table-bordered table-striped">
				    <thead>
				    <tr>
				      <th>Nombre</th>
				      @if (!empty($puntos_referidos))
				      	<th>puntos (incluyendo los puntos que te han dado tus referidos)</th>
				      @else
				      	<th>Puntos</th>
				      @endif
				      <th>Tu codigo</th>
				    </tr>
				    </thead>
				    <tbody>
				    @if (!empty($puntos_normales))
				        <tr>
				          <td>{{ Auth::user()->name }}</td>
				      	@if (!empty($puntos_referidos))
				          <td>{{ ($puntos_normales[0]->sum ) + ($puntos_referidos[0]->points) }}</td>          
				    	@else
				          <td>{{ $puntos_normales[0]->sum   }}  </td>          
				    	@endif
				    	<td>{{Auth::user()->id}}</td>
				        </tr>
				    @endif
				    </tbody>
				   
				  </table>
				</div>
				<!-- /.box-body -->
				<a href="{{ route('raiz') }}" onclick="goBack()">atras</a><br>
			</div>
		</div>
	    <div class="row">
	  
	</div>
	<script>
		function goBack() {
		    window.history.back();
		}
	</script>

	<hr>

@endsection