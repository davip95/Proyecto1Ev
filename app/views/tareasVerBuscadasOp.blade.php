@extends('plantilla_op')
@section('cuerpo')
<h1>Resultados de búsqueda</h1>
<br>
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-striped table-responsive table-condensed" id="listaTareas">
        <thead class="table-dark">
            <tr>
                <th>Fecha Creación</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Descripción</th>
                <th>Población</th>
                <th>Estado</th>
                <th>Fecha Realización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
            <tr>
                <td>{{$tarea['fechacreacion']}}</td>
                <td>{{$tarea['dni']}}</td>
                <td>{{$tarea['nombre']}}</td>
                <td>{{$tarea['apellidos']}}</td>
                <td>{{$tarea['telefono']}}</td>
                <td>{{$tarea['descripcion']}}</td>
                <td>{{$tarea['poblacion']}}</td>
                <td>{{$tarea['estado']}}</td>
                <td>{{$tarea['fechafin']}}</td>
                <td>
                    <a href="index.php?controller=tareas&action=opVer&id={{$tarea['idtarea']}}" class="btn btn-info" role="button">Detalles</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<h5><em>Resultado(s): {{$conteo}} tarea(s)</em></h5>
@endsection