
<?php $__env->startSection('cuerpo'); ?>
<h1>Tarea <?php echo e($tarea['idtarea']); ?></h1>
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
            <th>Código Postal</th>
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
            <td><?php echo e($tarea['codpostal']); ?></td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Provincia</th>
            <th>Estado</th>
            <th>ID Operario</th>
            <th>Fecha Creación</th>
            <th>Fecha Realización</th>
            <th>Anotaciones Anteriores</th>
            <th>Anotaciones Posteriores</th>
            <th>Fichero Adjunto</th>
            <th>Foto Adjunta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($tarea['provincia']); ?></td>
            <td><?php echo e($tarea['estado']); ?></td>
            <td><?php echo e($tarea['idusuario']); ?></td>
            <td><?php echo e($tarea['fechacreacion']); ?></td>
            <td><?php echo e($tarea['fechafin']); ?></td>
            <td><?php echo e($tarea['anotaantes']); ?></td>
            <td><?php echo e($tarea['anotapost']); ?></td>
            <td><?php echo e($tarea['fichero']); ?> <br>
                <?php if($tarea['fichero'] != '' && $tarea['fichero'] != NULL): ?>
                <a class='btn btn-primary' href="<?= BASE_URL . "archivos/" . $tarea['fichero'] ?>" download>Descargar</a>
                <?php endif; ?>
            </td>
            <td><?php echo e($tarea['foto']); ?> <br>
                <?php if($tarea['foto'] != '' && $tarea['foto'] != NULL): ?>
                <a class='btn btn-primary' href="<?= BASE_URL . "archivos/" . $tarea['foto'] ?>" download>Descargar</a>
                <?php endif; ?>
            </td>
            <td>
                <!-- Solo muestro el boton de completar si la tarea no está realizada -->
                <?php if($tarea['estado'] != 'R'): ?>
                <a href="index.php?controller=tareas&action=completaTarea&id=<?php echo e($tarea['idtarea']); ?>" class="btn btn-success" role="button">Completar</a>
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="index.php?controller=tareas&action=opListar" class="btn btn-primary" role="button">Ir a Listado</a></h5>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_op', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/tareaVerDetallesOp.blade.php ENDPATH**/ ?>