@extends('plantilla_op')
@section('cuerpo')
<h1>Completar Tarea {{$tarea['idtarea']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Tarea</th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['idtarea']}}</td>
            <td>{{$tarea['dni']}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['apellidos']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['correo']}}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Direccion</th>
            <th>Población</th>
            <th>Código Postal</th>
            <th>Provincia</th>
            <th>ID Operario</th>
            <th>Fecha Creación</th>
            <th>Anotaciones Anteriores</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['direccion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['codpostal']}}</td>
            <td>{{$tarea['provincia']}}</td>
            <td>{{$tarea['idusuario']}}</td>
            <td>{{$tarea['fechacreacion']}}</td>
            <td>{{$tarea['anotaantes']}}</td>
        </tr>
    </tbody>
</table>
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Estado</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B">
                    <label class="form-check-label" for="espera">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="P">
                    <label class="form-check-label" for="espera">P</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="R" checked>
                    <label class="form-check-label" for="realizada">R</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="C">
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
                {!!$error->ErrorFormateado('estado')!!}
            </div>
            <div class="columnacampos">
                <label class="form-label">Fecha de realización</label><br>
                <input type="date" name="fechafin" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                {!!$error->ErrorFormateado('fechafin')!!}<br>
                <label class="form-label">Anotaciones posteriores</label><br>
                <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1">{{$tarea['anotapost']}}</textarea>
            </div>
            <div class="columnacampos">
                <label class="form-label">Fichero resumen</label><br>
                <input type="file" name="fichero" class="form-control form-control-sm" id="formFileSm"><br>

                <label class="form-label">Foto del trabajo</label><br>
                <input type="file" name="foto" class="form-control form-control-sm" id="formFileSm">
            </div>
            <div class="columnacampos">
                <br><br><br><br>
                <input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href="index.php?controller=tareas&action=ver&id={{$tarea['idtarea']}}" class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
@endsection