
<?php $__env->startSection('cuerpo'); ?>
<h1>Completar Tarea <?php echo e($tarea['idtarea']); ?></h1>
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
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Direccion</th>
            <th>Población</th>
            <th>Código Postal</th>
            <th>Provincia</th>
            <th>ID Operario</th>
            <th>Fecha Creación</th>
            <th>Anotaciones Anteriores</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($tarea['direccion']); ?></td>
            <td><?php echo e($tarea['poblacion']); ?></td>
            <td><?php echo e($tarea['codpostal']); ?></td>
            <td><?php echo e($tarea['provincia']); ?></td>
            <td><?php echo e($tarea['idusuario']); ?></td>
            <td><?php echo e($tarea['fechacreacion']); ?></td>
            <td><?php echo e($tarea['anotaantes']); ?></td>
        </tr>
    </tbody>
</table>
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Estado</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B">
                    <label class="form-check-label" for="espera">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="P">
                    <label class="form-check-label" for="espera">P</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="R" checked>
                    <label class="form-check-label" for="realizada">R</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="C">
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
                <?php echo $error->ErrorFormateado('estado'); ?>

            </div>
            <div class="columnacampos">
                <label class="form-label">Fecha de realización</label><br>
                <input type="date" name="fechafin" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                <?php echo $error->ErrorFormateado('fechafin'); ?><br>
                <label class="form-label">Anotaciones posteriores</label><br>
                <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1"><?php echo e($tarea['anotapost']); ?></textarea>
            </div>
            <div class="columnacampos">
                <label class="form-label">Fichero resumen</label><br>
                <input type="file" name="fichero" class="form-control form-control-sm" id="formFileSm"><br>

                <label class="form-label">Foto del trabajo</label><br>
                <input type="file" name="foto" class="form-control form-control-sm" id="formFileSm">
            </div>
            <div class="columnacampos">
                <br><br><br><br>
                <input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href="index.php?controller=tareas&action=ver&id=<?php echo e($tarea['idtarea']); ?>" class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/tareaCompletar.blade.php ENDPATH**/ ?>