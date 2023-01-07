@extends('plantilla_admin')
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
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$usuario['idusuario']}}</td>
            <td>{{$usuario['nombre']}}</td>
            <td>{{$usuario['pass']}}</td>
            <td>{{$usuario['tipo']}}</td>
        </tr>
    </tbody>
</table>
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Asegúrese de que quiere eliminar el usuario antes de confirmarlo.</strong></div>
<h5><a href="index.php?controller=usuarios&action=ver&id={{$usuario['idusuario']}}" class="btn btn-danger" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
<h5><a href="index.php?controller=usuarios&action=eliminarUsuario&id={{$usuario['idusuario']}}" class="btn btn-success" role="button"><i class="bi bi-check-square"></i> Confirmar Borrado</a></h5>
@endsection