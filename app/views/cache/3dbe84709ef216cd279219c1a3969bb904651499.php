
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
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($usuario['idusuario']); ?></td>
            <td><?php echo e($usuario['nombre']); ?></td>
            <td><?php echo e($usuario['pass']); ?></td>
            <td><?php echo e($usuario['tipo']); ?></td>
            <td>
                <a href="index.php?controller=usuarios&action=cambiaNombrePass&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-warning" role="button">Cambiar Usuario/Clave</a>
                &nbsp;
                <a href="index.php?controller=usuarios&action=confirmarEliminarUsuario&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-danger" role="button">Borrar Usuario</a>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="index.php?controller=usuarios&action=listar" class="btn btn-primary" role="button">Ir a Listado de Usuarios</a></h5>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/usuarioVerDetalles.blade.php ENDPATH**/ ?>