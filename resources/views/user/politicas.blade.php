@extends('user/appo')

@section('bg-img',asset('user/img/politicas.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
	<!-- Main Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-offset-3 text-center">
				<h3>Nuestras Politicas</h3>
				<p>
					{!! $policies[0]->body !!}
				</p>
			</div>
		</div>
	    <div class="row">
	  
	</div>

	<hr>

@endsection