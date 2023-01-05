@extends('plantilla_op')
@section('cuerpo')
<h1>Lista de tareas pendientes</h1>
<br>
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

<nav>
    <h5><em>Páginas</em></h5>
    <ul class="pagination">
        <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás y el de ir a la primera -->
        @if ($pagina > 1)
        <li>
            <a href="index.php?controller=tareas&action=opListar">
                <span>&laquo;</span>
            </a>
        </li>
        <li>
            <a href="index.php?controller=tareas&action=opListar&pagina={{$pagina-1}}">
                <span aria-hidden="true">&lt;</span>
            </a>
        </li>
        @endif
        <!-- Mostramos enlaces para ir a todas las páginas con un bucle for-->
        @for ($x = 1; $x <= $paginas; $x++) @if ($x==$pagina) <li class="active">
            @else
            <li>
                @endif
                <a href="index.php?controller=tareas&action=opListar&pagina={{$x}}">
                    {{$x}}</a>
            </li>
            @endfor
            <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante y el de ir a la última -->
            @if ($pagina < $paginas) <li>
                <a href="index.php?controller=tareas&action=opListar&pagina={{$pagina+1}}">
                    <span aria-hidden="true">&gt;</span>
                </a>
                </li>
                <li>
                    <a href="index.php?controller=tareas&action=opListar&pagina={{$paginas}}">
                        <span>&raquo;</span>
                    </a>
                </li>
                @endif
    </ul>
</nav>
<h5><em>Tareas pendientes totales: {{$conteo}}</em></h5>
@endsection