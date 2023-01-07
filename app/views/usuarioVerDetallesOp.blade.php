@extends('plantilla_op')
@section('cuerpo')
<h1>Usuario {{$usuario['idusuario']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$usuario['idusuario']}}</td>
            <td>{{$usuario['nombre']}}</td>
            <td>{{$usuario['pass']}}</td>
            <td>{{$usuario['tipo']}}</td>
            <td><a href="index.php?controller=usuarios&action=opCambiaNombrePass&id={{$usuario['idusuario']}}" class="btn btn-success" role="button">Cambiar usuario/clave</a></td>
        </tr>
    </tbody>
</table>
<h5><a href="index.php?controller=tareas&action=opListar" class="btn btn-primary" role="button">Ir a Listado de Tareas</a></h5>

@endsection