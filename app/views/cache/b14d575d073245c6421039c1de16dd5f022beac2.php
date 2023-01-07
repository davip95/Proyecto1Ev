
<?php $__env->startSection('cuerpo'); ?>
<h1>Usuario <?php echo e($usuario['idusuario']); ?></h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($usuario['idusuario']); ?></td>
            <td><?php echo e($usuario['nombre']); ?></td>
            <td><?php echo e($usuario['pass']); ?></td>
            <td><?php echo e($usuario['tipo']); ?></td>
        </tr>
    </tbody>
</table>
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Asegúrese de que quiere eliminar el usuario antes de confirmarlo.</strong></div>
<h5><a href="index.php?controller=usuarios&action=ver&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-danger" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
<h5><a href="index.php?controller=usuarios&action=eliminarUsuario&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-success" role="button"><i class="bi bi-check-square"></i> Confirmar Borrado</a></h5>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/usuarioEliminar.blade.php ENDPATH**/ ?>