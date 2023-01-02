
<?php $__env->startSection('cuerpo'); ?>
<h1>Eliminar Tarea <?php echo e($tarea['idtarea']); ?></h1>
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
            <td><?php echo e($tarea['idtarea']); ?></td>
            <td><?php echo e($tarea['dni']); ?></td>
            <td><?php echo e($tarea['nombre']); ?></td>
            <td><?php echo e($tarea['apellidos']); ?></td>
            <td><?php echo e($tarea['telefono']); ?></td>
            <td><?php echo e($tarea['descripcion']); ?></td>
            <td><?php echo e($tarea['correo']); ?></td>
            <td><?php echo e($tarea['direccion']); ?></td>
            <td><?php echo e($tarea['poblacion']); ?></td>
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
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($tarea['codpostal']); ?></td>
            <td><?php echo e($tarea['provincia']); ?></td>
            <td><?php echo e($tarea['estado']); ?></td>
            <td><?php echo e($tarea['idusuario']); ?></td>
            <td><?php echo e($tarea['fechacreacion']); ?></td>
            <td><?php echo e($tarea['fechafin']); ?></td>
            <td><?php echo e($tarea['anotaantes']); ?></td>
            <td><?php echo e($tarea['anotapost']); ?></td>
        </tr>
    </tbody>
</table>
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Asegúrese de que quiere eliminar la tarea antes de confirmarlo.</strong></div>
<h5><a href="index.php?controller=tareas&action=ver&id=<?php echo e($tarea['idtarea']); ?>" class="btn btn-danger" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
<h5><a href="index.php?controller=tareas&action=eliminarTarea&id=<?php echo e($tarea['idtarea']); ?>" class="btn btn-success" role="button"><i class="bi bi-check-square"></i> Confirmar Borrado</a></h5>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/tareaEliminar.blade.php ENDPATH**/ ?>