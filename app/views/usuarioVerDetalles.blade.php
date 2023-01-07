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
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$usuario['idusuario']}}</td>
            <td>{{$usuario['nombre']}}</td>
            <td>{{$usuario['pass']}}</td>
            <td>{{$usuario['tipo']}}</td>
            <td>
                <a href="index.php?controller=usuarios&action=cambiaNombrePass&id={{$usuario['idusuario']}}" class="btn btn-warning" role="button">Cambiar Usuario/Clave</a>
                &nbsp;
                <a href="index.php?controller=usuarios&action=confirmaEliminar&id={{$usuario['idusuario']}}" class="btn btn-danger" role="button">Borrar Usuario</a>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="index.php?controller=usuarios&action=listar" class="btn btn-primary" role="button">Ir a Listado de Usuarios</a></h5>

@endsection