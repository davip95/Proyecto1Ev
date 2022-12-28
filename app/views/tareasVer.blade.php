@extends('plantilla_admin')
@section('cuerpo')
<h1 class="display-5">Lista de tareas</h1>
<table class="table table-striped table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Fecha Realización</th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Población</th>
            <th>Estado</th>
            <th>Fecha Creación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tareas as $tarea)
        <tr>
            <td>{{$tarea['fechafin']}}</td>
            <td>{{$tarea['dni']}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['apellidos']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['estado']}}</td>
            <td>{{$tarea['fechacreacion']}}</td>
            <td>
                <a href="" class="btn btn-info" role="button">Detalles</a>
                <a href="" class="btn btn-warning" role="button">Editar</a>
                <a href="" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection