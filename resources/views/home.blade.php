@extends('user/app')

@section('bg-img',asset('user/img/contact-bg.jpg'))
@section('head')

@endsection
@section('title','Enhora buena!, bienvenido')
@section('sub-heading','')

@section('main-content')
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
           <a href="{{route('raiz')}}">Vamos al inicio!</a>
        </div>
    </div>
</article>

<hr>
@endsection
@section('footer')
@endsection
