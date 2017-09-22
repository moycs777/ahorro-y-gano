@extends('user/app')

@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','Ahorra comprando!')
@section('sub-heading','Gana fabulosos premios')

@section('main-content')
	
	<!-- Main Content -->
	<div class="container">
		<div class="row">
			<p>Click the button to get your coordinates.</p>

				<button onclick="getLocation()">Buscar tiendas cercanas</button>

			<p id="demo"></p>
		</div>
	    <div class="row">
	    <p>Ofertas</p>
	    @foreach ($ofertas as $item)
            <form role="form" action="{{ route('usercoupon.store') }}" method="post" enctype="multipart/form-data">
            	{{ csrf_field() }}
            	{{-- <input type="hidden" name="promotion_id" value="{{ $item->id }}"> --}}           	
            	<input type="hidden" name="promotion" value="{{ $item }}">           	
	            <div class="col-md-4 col-sm-6 col-xs-6">
	                <div class="asd"><img class="img-responsive" WIDTH="250" HEIGHT="250" alt="" src="{{  url($item->picture)}}" /></div>
	                <a href="{{ route('raiz') }}">
	                    <h2 class="post-title">
	                    	{{ $item->name }}
	                    </h2>
	                    <h3 class="post-subtitle">
	                        {{ $item->description }}
	                    </h3>
	                </a>
	                <p class="post-meta">Tienda:  <a href="#">{{  $item->store->name}}</a> </p>
	                <p class="post-meta">Provincia: {{  $item->store->state}}</p>
	                <p class="post-meta">Provincia: {{  $item->store->city}}</p>
	                <p class="post-meta">Se creo hace:  {{ $item->created_at->diffForHumans() }}</p>
	                <p class="post-meta">Vence:   {{ $item->expires }}</p>
	                @if ($item->type ==1)
	                	<p>Precio: {{  $item->price_with_offert}} €</p>
	                @endif
	                @if ($item->type ==2)
	                	<p>A partir de: {{  $item->price_not_offert}} €</p>
	                @endif
	                <input type="submit" class="btn btn-primary block" value="Descargar">
	            </div>
            </form>
        @endforeach
	    <div class="col-md-4 col-sm-6 col-xs-6">
	    	
	    </div>	
	        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
	            
	            <hr>
	            <!-- Pager -->
	            <ul class="pager">
	                <li class="next">
	                	{{ $ofertas->links() }}
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>

	<hr>
<script>
	var x = document.getElementById("demo");
	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition);
	    } else {
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}
	function showPosition(position) {
	    x.innerHTML = "Latitude: " + position.coords.latitude + 
	    "<br>Longitude: " + position.coords.longitude; 
	}
</script>
@endsection