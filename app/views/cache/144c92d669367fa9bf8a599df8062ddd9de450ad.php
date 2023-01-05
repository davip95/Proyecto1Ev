
<?php $__env->startSection('cuerpo'); ?>
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
            <?php $__currentLoopData = $tareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($tarea['fechacreacion']); ?></td>
                <td><?php echo e($tarea['dni']); ?></td>
                <td><?php echo e($tarea['nombre']); ?></td>
                <td><?php echo e($tarea['apellidos']); ?></td>
                <td><?php echo e($tarea['telefono']); ?></td>
                <td><?php echo e($tarea['descripcion']); ?></td>
                <td><?php echo e($tarea['poblacion']); ?></td>
                <td><?php echo e($tarea['estado']); ?></td>
                <td><?php echo e($tarea['fechafin']); ?></td>
                <td>
                    <a href="index.php?controller=tareas&action=opVer&id=<?php echo e($tarea['idtarea']); ?>" class="btn btn-info" role="button">Detalles</a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<br>
<h5><em>Resultado(s): <?php echo e($conteo); ?> tarea(s)</em></h5>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_op', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/tareasVerBuscadasOp.blade.php ENDPATH**/ ?>