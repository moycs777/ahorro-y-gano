@extends('user/app')

@section('bg-img',asset('user/img/contact-bg.jpg'))
@section('head')

@endsection
@section('title','Register Here')
@section('sub-heading','')

@section('main-content')
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
           <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
               {{ csrf_field() }}

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                   <label for="name" class="col-md-4 control-label">Nombre</label>

                   <div class="col-md-6">
                       <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                       @if ($errors->has('name'))
                           <span class="help-block">
                               <strong>{{ $errors->first('name') }}</strong>
                           </span>
                       @endif
                   </div>
               </div>

               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                   <label for="email" class="col-md-4 control-label">E-Mail</label>

                   <div class="col-md-6">
                       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                       @if ($errors->has('email'))
                           <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                           </span>
                       @endif
                   </div>
               </div>

               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                   <label for="password" class="col-md-4 control-label">Clave</label>

                   <div class="col-md-6">
                       <input id="password" type="password" class="form-control" name="password" required>

                       @if ($errors->has('password'))
                           <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                   </div>
               </div>

               <div class="form-group">
                   <label for="password-confirm" class="col-md-4 control-label">Confirmar Clave</label>

                   <div class="col-md-6">
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                   </div>
               </div>

               <div class="form-group{{ $errors->has('reffer_id') ? ' has-error' : '' }}">
                   <label for="reffer_id" class="col-md-4 control-label">Codigo de tu referido</label>

                   <div class="col-md-6">
                       <input id="reffer_id" type="num" class="form-control" min="1" name="reffer_id" value="{{ old('reffer_id') }}" required autofocus>

                       @if ($errors->has('reffer_id'))
                           <span class="help-block">
                               <strong>{{ $errors->first('reffer_id') }}</strong>
                           </span>
                       @endif
                   </div>
               </div>

               <div class="form-group">
                   <div class="col-md-6 col-md-offset-4">
                       <button type="submit" class="btn btn-primary">
                           Registrar
                       </button>
                   </div>
               </div>
               <div class="form-group">
                   <div class="col-md-6 col-md-offset-4">
                     <a href="{{ route('politicas') }}" target="blank">Ver politicas</a><br>
                     <input type="checkbox" value="check" id="agree" required checked /> He leido y acepto las politicas de uso y privacidad
                   </div>
               </div>
           </form>
        </div>
    </div>
</article>

<hr>
@endsection
@section('footer')
@endsection

