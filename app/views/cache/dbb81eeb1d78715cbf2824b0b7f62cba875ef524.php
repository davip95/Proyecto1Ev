
<?php $__env->startSection('cuerpo'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/inicioVista.blade.php ENDPATH**/ ?>