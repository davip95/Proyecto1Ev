
<?php $__env->startSection('cuerpo'); ?>
<h1>Modificar tarea <?php echo e($tarea['idtarea']); ?></h1>
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">NIF o CIF</label><br>
                <input type="text" name="dni" class="form-control form-control-sm" value="<?php echo e($tarea['dni']); ?>">
                <?php echo $error->ErrorFormateado('dni'); ?><br>
                <label class="form-label">Nombre</label><br>
                <input type="text" name="nombre" class="form-control form-control-sm" value="<?php echo e($tarea['nombre']); ?>">
                <?php echo $error->ErrorFormateado('nombre'); ?><br>
                <label class="form-label">Apellidos</label><br>
                <input type="text" name="apellidos" class="form-control form-control-sm" value="<?php echo e($tarea['apellidos']); ?>">
                <?php echo $error->ErrorFormateado('apellidos'); ?><br>
                <label class="form-label">Teléfono contacto</label><br>
                <input type="text" name="telefono" class="form-control form-control-sm" value="<?php echo e($tarea['telefono']); ?>">
                <div class="form-text info">Debe ser de España. Puede separar los dígitos con espacio o guión.</div>
                <?php echo $error->ErrorFormateado('telefono'); ?><br>
                <label class="form-label">Descripción</label><br>
                <input type="text" name="descripcion" class="form-control form-control-sm" value="<?php echo e($tarea['descripcion']); ?>">
                <?php echo $error->ErrorFormateado('descripcion'); ?><br>
                <label class="form-label">Correo electrónico</label><br>
                <input type="text" name="correo" class="form-control form-control-sm" value="<?php echo e($tarea['correo']); ?>">
                <?php echo $error->ErrorFormateado('correo'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Dirección</label><br>
                <input type="text" name="direccion" class="form-control form-control-sm" value="<?php echo e($tarea['direccion']); ?>">
                <?php echo $error->ErrorFormateado('direccion'); ?><br>
                <label class="form-label">Población</label><br>
                <input type="text" name="poblacion" class="form-control form-control-sm" value="<?php echo e($tarea['poblacion']); ?>">
                <?php echo $error->ErrorFormateado('poblacion'); ?><br>
                <label class="form-label">Código Postal</label><br>
                <input type="text" name="codpostal" class="form-control form-control-sm" value="<?php echo e($tarea['codpostal']); ?>">
                <?php echo $error->ErrorFormateado('codpostal'); ?><br>
                <label class="form-label">Provincia</label><br>
                <select class="form-select form-select-lg" name="provincia">
                    <option disabled>Selecciona provincia</option>
                    <?php $__currentLoopData = $provincias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tarea['provincia'] == $provincia["nombre"]): ?>
                    <option value="<?php echo e($provincia['nombre']); ?>" selected> <?php echo e($provincia["nombre"]); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($provincia['nombre']); ?>"> <?php echo e($provincia["nombre"]); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo $error->ErrorFormateado('provincia'); ?>

                <br><br>
                <label class="form-label">Estado</label><br>
                <div class="form-check">
                    <?php if($tarea['estado'] == 'B'): ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B" checked>
                    <?php else: ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B">
                    <?php endif; ?>
                    <label class="form-check-label" for="espera">B</label>

                </div>
                <div class="form-check">
                    <?php if($tarea['estado'] == 'P'): ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="P" checked>
                    <?php else: ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="P">
                    <?php endif; ?>
                    <label class="form-check-label" for="espera">P</label>
                </div>
                <div class="form-check">
                    <?php if($tarea['estado'] == 'R'): ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="R" checked>
                    <?php else: ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="R">
                    <?php endif; ?>
                    <label class="form-check-label" for="realizada">R</label>
                </div>
                <div class="form-check">
                    <?php if($tarea['estado'] == 'C'): ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="C" checked>
                    <?php else: ?>
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="C">
                    <?php endif; ?>
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
                <?php echo $error->ErrorFormateado('estado'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Operario encargado</label><br>
                <select class="form-select form-select-lg" name="operario">
                    <option disabled>Selecciona operario</option>
                    <?php $__currentLoopData = $operarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tarea['operario'] == $operario["idusuario"]): ?>
                    <option value="<?php echo e($operario['idusuario']); ?>" selected><?php echo e($operario["nombre"]); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($operario['idusuario']); ?>"><?php echo e($operario["nombre"]); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo $error->ErrorFormateado('operario'); ?>

                <br>
                <label class="form-label">Fecha de creación de tarea</label><br>
                <input type="date" name="fechacreacion" class="form-control form-control-sm" value="<?php echo e($tarea['fechacreacion']); ?>">
                <?php echo $error->ErrorFormateado('fechacreacion'); ?><br>
                <label class="form-label">Fecha de realización</label><br>
                <input type="date" name="fechafin" class="form-control form-control-sm" value="<?php echo e($tarea['fechafin']); ?>">
                <?php echo $error->ErrorFormateado('fechafin'); ?><br>
                <label class="form-label">Anotaciones anteriores</label><br>
                <textarea name="anotaantes" class="form-control form-control-sm" cols="10" rows="1"><?php echo e($tarea['anotaantes']); ?></textarea><br>

                <label class="form-label">Anotaciones posteriores</label><br>
                <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1"><?php echo e($tarea['anotapost']); ?></textarea><br>

                <!-- <label class="form-label">Fichero resumen</label><br>
                <input type="file" name="fichero" class="form-control form-control-sm" id="formFileSm"><br>

                <label class="form-label">Foto del trabajo</label><br>
                <input type="file" name="foto" class="form-control form-control-sm" id="formFileSm"><br><br><br> -->
                <br><input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href="index.php?controller=tareas&action=ver&id=<?php echo e($tarea['idtarea']); ?>" class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/tareaModificar.blade.php ENDPATH**/ ?>