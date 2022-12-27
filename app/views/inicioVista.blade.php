@extends('plantilla_admin')
@section('cuerpo')
<section>
    <div>
        <br>
        <a href="index.php?controller=tareas&action=listar" class="btn btn-primary" role="button">Ver Incidencias/Tareas</a>
        <br><br>
        <a href="index.php?controller=tareas&action=crear" class="btn btn-primary" role="button">Añadir Incidencia/Tarea</a>
        <br><br>
        <a href="index.php?controller=tareas&action=modificar" class="btn btn-primary" role="button">Modificar Incidencia/Tarea</a>
        <br><br>
        <a href="index.php?controller=tareas&action=eliminar" class="btn btn-primary" role="button">Eliminar Incidencia/Tarea</a>
        <br><br>
        <a href="index.php?controller=tareas&action=cambiar" class="btn btn-primary" role="button">Cambiar Estado Incidencia/Tarea</a>
        <br><br>
        <a href="index.php?controller=tareas&action=completar" class="btn btn-primary" role="button">Completar Incidencia/Tarea</a>
        <br><br>
        <a href="index.php?controller=tareas&action=buscar" class="btn btn-primary" role="button">Buscar Incidencia/Tarea</a>
        <br><br>
    </div>
</section>
@endsection