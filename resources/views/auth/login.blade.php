@extends('auth.contenido')
@section('login')
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card-group mb-0">
<div class="card p-4">

<form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
{{csrf_field() }}
<div class="card-body">
<h2>Iniciar Sesión</h2>

</div>
<p class="text-muted">Ingrese los datos</p>
<div class="form-groupe mb-3 {{$errors->has('usuario' ? 'is-invalid' :'') }}">
<span class="input-group-addon"><i class="icon-user"></i></span>
<input type="text" value="{{ old('usuario') }}" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
{!!$errors->first('usuario','<span class="invalid-feedback"> :message</span>')!!}
</div>
<br>
<div  class="form-groupe mb-3 {{$errors->has('password' ? 'is-invalid' :'') }}">
<span class="input-group-addon"><i class="icon-lock"></i></span>
<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
{!!$errors->first('password','<span class="invalid-feedback"> :message</span>')!!}
</div>
<br>
<div class="row">
<div class="col-6">
<button type="submit" class="btn btn-dark px-4">Ingresar</button>
</div>
</div>


</form>

</div>

<div class="card text-white bg-dark">

<img src="img/8.png">
<div class="card-body text-center" style="font-family:Helvetica,Futura,Arial,Verdana,sans-serif;">
<h3>CHATARRA SOBRE RUEDAS</h3>
<h6 class="text-muted">Comida Rapida a Domicilio</h6>
</div>

</div>

</div>
   
</div>

</div>

@endsection