@extends('user/appo')

@section('bg-img',asset('user/img/politicas.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
	<!-- Main Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-offset-3 text-center">
				<h3>Confirma tu correo para continuar</h3>
				<p>
					Revisa tu correo, incluso en la bandeja de spam
				</p>
				<a href="{{ route('raiz') }}">ir al inicio</a><br>
			</div>
		</div>
	    <div class="row">
	  
	</div>

	<hr>

@endsection