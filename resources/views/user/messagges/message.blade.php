@extends('user/appo')

@section('bg-img',asset('user/img/politicas.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
	<!-- Main Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-offset-3 text-center">
				<h3>Mensaje</h3>
				<p>
					{{$mensaje}}
				</p>
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