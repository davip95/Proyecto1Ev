@extends('plantilla_op')
@section('cuerpo')
<h1>Cambiar Nombre/Clave Usuario {{$usuario['idusuario']}}</h1>
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
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nuevo Nombre</label>
                <input type="text" name="nuevonombre" class="form-control form-control-sm">
                <div class="form-text info">Si no quiere cambiar el nombre, no rellene esta entrada.</div>
                {!!$error->ErrorFormateado('nuevonombre')!!}
            </div>
            <div class="columnacampos">
                <label class="form-label">Nueva Contraseña</label>
                <input type="password" name="nuevapass" class="form-control form-control-sm">
                {!!$error->ErrorFormateado('nuevapass')!!}<br>
            </div>
            <div class="columnacampos">
                <label class="form-label">Repita Nueva Contraseña</label>
                <input type="password" name="nuevapassrep" class="form-control form-control-sm">
            </div>
            <div class="columnacampos">
                <input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href="index.php?controller=usuarios&action=opVer&id={{$usuario['idusuario']}}" class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
<h5>{!!$error->ErrorFormateado('editar')!!}</h5>
@endsection