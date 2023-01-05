
<?php $__env->startSection('cuerpo'); ?>
<h1>Añadir nueva tarea</h1>
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">NIF o CIF</label><br>
                <input type="text" name="dni" class="form-control form-control-sm" value="<?= isset($_POST['dni']) ? $_POST['dni'] : '' ?>">
                <?php echo $error->ErrorFormateado('dni'); ?><br>
                <label class="form-label">Nombre</label><br>
                <input type="text" name="nombre" class="form-control form-control-sm" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>">
                <?php echo $error->ErrorFormateado('nombre'); ?><br>
                <label class="form-label">Apellidos</label><br>
                <input type="text" name="apellidos" class="form-control form-control-sm" value="<?= isset($_POST['apellidos']) ? $_POST['apellidos'] : '' ?>">
                <?php echo $error->ErrorFormateado('apellidos'); ?><br>
                <label class="form-label">Teléfono contacto</label><br>
                <input type="text" name="telefono" class="form-control form-control-sm" value="<?= isset($_POST['telefono']) ? $_POST['telefono'] : '' ?>">
                <div class="form-text info">Debe ser de España. Puede separar los dígitos con espacio o guión.</div>
                <?php echo $error->ErrorFormateado('telefono'); ?><br>
                <label class="form-label">Descripción</label><br>
                <input type="text" name="descripcion" class="form-control form-control-sm" value="<?= isset($_POST['descripcion']) ? $_POST['descripcion'] : '' ?>">
                <?php echo $error->ErrorFormateado('descripcion'); ?><br>
                <label class="form-label">Correo electrónico</label><br>
                <input type="text" name="correo" class="form-control form-control-sm" value="<?= isset($_POST['correo']) ? $_POST['correo'] : '' ?>">
                <?php echo $error->ErrorFormateado('correo'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Dirección</label><br>
                <input type="text" name="direccion" class="form-control form-control-sm" value="<?= isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>">
                <?php echo $error->ErrorFormateado('direccion'); ?><br>
                <label class="form-label">Población</label><br>
                <input type="text" name="poblacion" class="form-control form-control-sm" value="<?= isset($_POST['poblacion']) ? $_POST['poblacion'] : '' ?>">
                <?php echo $error->ErrorFormateado('poblacion'); ?><br>
                <label class="form-label">Código Postal</label><br>
                <input type="text" name="codpostal" class="form-control form-control-sm" value="<?= isset($_POST['codpostal']) ? $_POST['codpostal'] : '' ?>">
                <?php echo $error->ErrorFormateado('codpostal'); ?><br>
                <label class="form-label">Provincia</label><br>
                <select class="form-select form-select-lg" name="provincia">
                    <option disabled selected>Selecciona provincia</option>
                    <?php $__currentLoopData = $provincias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($_POST['provincia'] == $provincia['nombre']): ?>
                    <option value="<?php echo e($provincia['nombre']); ?>" selected><?php echo e($provincia["nombre"]); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($provincia['nombre']); ?>"><?php echo e($provincia["nombre"]); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo $error->ErrorFormateado('provincia'); ?>

                <br><br>
                <label class="form-label">Estado</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B" <?= isset($_POST['estado']) && $_POST['estado'] == 'B' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="espera">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="pendiente" value="P" <?= isset($_POST['estado']) && $_POST['estado'] == 'P' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="espera">P</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="realizada" value="R" <?= isset($_POST['estado']) && $_POST['estado'] == 'R' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="realizada">R</label>

                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="cancelada" value="C" <?= isset($_POST['estado']) && $_POST['estado'] == 'C' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
                <?php echo $error->ErrorFormateado('estado'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Operario encargado</label><br>
                <select class="form-select form-select-lg" name="operario">
                    <option disabled selected>Selecciona operario</option>
                    <?php $__currentLoopData = $operarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($_POST['operario'] == $operario['idusuario']): ?>
                    <option value="<?php echo e($operario['idusuario']); ?>" selected><?php echo e($operario["nombre"]); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($operario['idusuario']); ?>"><?php echo e($operario["nombre"]); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo $error->ErrorFormateado('operario'); ?>

                <br>
                <label class="form-label">Fecha de creación de tarea</label><br>
                <input type="date" name="fechacreacion" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                <?php echo $error->ErrorFormateado('fechacreacion'); ?><br>
                <label class="form-label">Fecha de realización</label><br>
                <input type="date" name="fechafin" class="form-control form-control-sm" value="<?= isset($_POST['fechafin']) ? $_POST['fechafin'] : '' ?>">
                <?php echo $error->ErrorFormateado('fechafin'); ?><br>
                <label class="form-label">Anotaciones anteriores</label><br>
                <textarea name="anotaantes" class="form-control form-control-sm" cols="10" rows="1"><?= isset($_POST['anotaantes']) ? $_POST['anotaantes'] : '' ?></textarea><br>

                <label class="form-label">Anotaciones posteriores</label><br>
                <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1"><?= isset($_POST['anotapost']) ? $_POST['anotapost'] : '' ?></textarea><br>

                <!-- <label class="form-label">Fichero resumen</label><br>
                <input type="file" name="fichero" class="form-control form-control-sm" id="formFileSm"><br>

                <label class="form-label">Foto del trabajo</label><br>
                <input type="file" name="foto" class="form-control form-control-sm" id="formFileSm"><br><br><br> -->
                <br><input class="btn btn-primary" type="submit" value="Añadir Tarea" id="añadir">
            </div>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/tareaAñadir.blade.php ENDPATH**/ ?>