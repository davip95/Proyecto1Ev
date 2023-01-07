
<?php $__env->startSection('cuerpo'); ?>
<h1>Usuario <?php echo e($idUsuario); ?> Eliminado</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>El usuario ha sido eliminado correctamente.</strong></div>
<h5><a href="index.php?controller=usuarios&action=listar" class="btn btn-primary" role="button">Ir a Listado de Usuarios</a></h5>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/usuarioEliminado.blade.php ENDPATH**/ ?>