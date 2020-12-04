@extends('plantilla')

@section('seccion1')
 <h1>Gestión <small class="text-muted">Clientes</small></h1>
 <br>
 <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Telefono</th>
      <th scope="col">Ubicación</th>
      <th scope="col">Correo</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($clientes as $objeto)
 
    <tr>
      <th scope="row">{{ $objeto->nombre }}</th>
      <th>{{ $objeto->apellido }}</th>
      <th>{{ $objeto->telefono }}</th>
      <th>{{ $objeto->ubicacion }}</th>
      <th>{{ $objeto->correo }}</th>    
    </tr>

    @endforeach

  </tbody>
</table>

@endsection
