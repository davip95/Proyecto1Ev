
<?php $__env->startSection('cuerpo'); ?>
<h1>Cambiar Nombre/Clave Usuario <?php echo e($usuario['idusuario']); ?></h1>
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
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nuevo Nombre</label>
                <input type="text" name="nuevonombre" class="form-control form-control-sm">
                <div class="form-text info">Si no quiere cambiar el nombre, no rellene esta entrada.</div>
                <?php echo $error->ErrorFormateado('nuevonombre'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Nueva Contraseña</label>
                <input type="password" name="nuevapass" class="form-control form-control-sm">
                <?php echo $error->ErrorFormateado('nuevapass'); ?><br>
            </div>
            <div class="columnacampos">
                <label class="form-label">Repita Nueva Contraseña</label>
                <input type="password" name="nuevapassrep" class="form-control form-control-sm">
            </div>
            <div class="columnacampos">
                <input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href="index.php?controller=usuarios&action=ver&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
<h5><?php echo $error->ErrorFormateado('editar'); ?></h5>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/usuarioModificar.blade.php ENDPATH**/ ?>