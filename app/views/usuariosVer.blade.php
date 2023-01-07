@extends('plantilla_admin')
@section('cuerpo')
<h1>Lista de usuarios</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <!-- <th>Contraseña</th> -->
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{$usuario['idusuario']}}</td>
            <td>{{$usuario['nombre']}}</td>
            <!-- <td>{{$usuario['pass']}}</td> -->
            <td>{{$usuario['tipo']}}</td>
            <td>
                <a href="index.php?controller=usuarios&action=ver&id={{$usuario['idusuario']}}" class="btn btn-info" role="button">Detalles</a>
                &nbsp;
                <a href="index.php?controller=usuarios&action=cambiaNombrePass&id={{$usuario['idusuario']}}" class="btn btn-warning" role="button">Cambiar Usuario/Clave</a>
                &nbsp;
                <a href="index.php?controller=usuarios&action=confirmarEliminarUsuario&id={{$usuario['idusuario']}}" class="btn btn-danger" role="button">Borrar Usuario</a>
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
            <a href="index.php?controller=usuarios&action=listar">
                <span>&laquo;</span>
            </a>
        </li>
        <li>
            <a href="index.php?controller=usuarios&action=listar&pagina={{$pagina-1}}">
                <span aria-hidden="true">&lt;</span>
            </a>
        </li>
        @endif
        <!-- Mostramos enlaces para ir a todas las páginas con un bucle for-->
        @for ($x = 1; $x <= $paginas; $x++) @if ($x==$pagina) <li class="active">
            @else
            <li>
                @endif
                <a href="index.php?controller=usuarios&action=listar&pagina={{$x}}">
                    {{$x}}</a>
            </li>
            @endfor
            <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante y el de ir a la última -->
            @if ($pagina < $paginas) <li>
                <a href="index.php?controller=usuarios&action=listar&pagina={{$pagina+1}}">
                    <span aria-hidden="true">&gt;</span>
                </a>
                </li>
                <li>
                    <a href="index.php?controller=usuarios&action=listar&pagina={{$paginas}}">
                        <span>&raquo;</span>
                    </a>
                </li>
                @endif
    </ul>
</nav>
<h5><em>Usuarios totales: {{$conteo}}</em></h5>
@endsection