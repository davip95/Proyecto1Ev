@extends('plantilla_admin')
@section('cuerpo')
<h1>Usuario {{$idUsuario}} Eliminado</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>El usuario ha sido eliminado correctamente.</strong></div>
<h5><a href="index.php?controller=usuarios&action=listar" class="btn btn-primary" role="button">Ir a Listado de Usuarios</a></h5>
@endsection