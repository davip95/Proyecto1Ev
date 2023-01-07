
<?php $__env->startSection('cuerpo'); ?>
<h1>Añadir nuevo usuario</h1>
<br>
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control form-control-sm" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>">
                <div class="form-text info">El nombre sólo puede contener letas y/o números.</div>
                <?php echo $error->ErrorFormateado('nombre'); ?><br>
                <label class="form-label">Contraseña</label>
                <input type="text" name="pass" class="form-control form-control-sm">
                <?php echo $error->ErrorFormateado('pass'); ?><br>
                <label class="form-label">Repita Contraseña</label>
                <input type="text" name="passrep" class="form-control form-control-sm">
                <?php echo $error->ErrorFormateado('passrep'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Tipo</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" value="operario" <?= isset($_POST['tipo']) && $_POST['tipo'] == 'operario' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="espera">Operario</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" value="administrador" <?= isset($_POST['tipo']) && $_POST['tipo'] == 'administrador' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="espera">Administrador</label>
                </div>
                <?php echo $error->ErrorFormateado('tipo'); ?><br><br>
                <br><input class="btn btn-primary" type="submit" value="Añadir Usuario" id="añadir">
                <br><a href="index.php?controller=Usuarios&action=listar" class="btn btn-danger" role="button">Volver a Usuarios</a>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/usuarioAñadir.blade.php ENDPATH**/ ?>