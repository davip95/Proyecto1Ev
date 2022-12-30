@extends('plantilla_admin')
@section('cuerpo')
<h1>Detalles de la tarea {{$tarea['idtarea']}}</h1>
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
            <th>Direccion</th>
            <th>Población</th>
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
            <td>{{$tarea['direccion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Código Postal</th>
            <th>Provincia</th>
            <th>Estado</th>
            <th>ID Operario</th>
            <th>Fecha Creación</th>
            <th>Fecha Realización</th>
            <th>Anotaciones Anteriores</th>
            <th>Anotaciones Posteriores</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['codpostal']}}</td>
            <td>{{$tarea['provincia']}}</td>
            <td>{{$tarea['estado']}}</td>
            <td>{{$tarea['idusuario']}}</td>
            <td>{{$tarea['fechacreacion']}}</td>
            <td>{{$tarea['fechafin']}}</td>
            <td>{{$tarea['anotaantes']}}</td>
            <td>{{$tarea['anotapost']}}</td>
            <td>
                <!-- Solo muestro el boton de completar si la tarea no está realizada -->
                @if($tarea['estado'] != 'R')
                <a href="" class="btn btn-success" role="button">Completar</a>
                @endif
                <a href="" class="btn btn-warning" role="button">Editar</a>
                <a href="" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="index.php?controller=tareas&action=listar" class="btn btn-primary" role="button">Ir a Listado</a></h5>

@endsection