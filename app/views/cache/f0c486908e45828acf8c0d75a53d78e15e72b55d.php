
<?php $__env->startSection('cuerpo'); ?>
<h1>Lista de usuarios</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <!-- <th>Contraseña</th> -->
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($usuario['idusuario']); ?></td>
            <td><?php echo e($usuario['nombre']); ?></td>
            <!-- <td><?php echo e($usuario['pass']); ?></td> -->
            <td><?php echo e($usuario['tipo']); ?></td>
            <td>
                <a href="index.php?controller=usuarios&action=ver&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-info" role="button">Detalles</a>
                &nbsp;
                <a href="index.php?controller=usuarios&action=cambiaNombrePass&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-warning" role="button">Cambiar Usuario/Clave</a>
                &nbsp;
                <a href="index.php?controller=usuarios&action=confirmarEliminarUsuario&id=<?php echo e($usuario['idusuario']); ?>" class="btn btn-danger" role="button">Borrar Usuario</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<nav>
    <h5><em>Páginas</em></h5>
    <ul class="pagination">
        <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás y el de ir a la primera -->
        <?php if($pagina > 1): ?>
        <li>
            <a href="index.php?controller=usuarios&action=listar">
                <span>&laquo;</span>
            </a>
        </li>
        <li>
            <a href="index.php?controller=usuarios&action=listar&pagina=<?php echo e($pagina-1); ?>">
                <span aria-hidden="true">&lt;</span>
            </a>
        </li>
        <?php endif; ?>
        <!-- Mostramos enlaces para ir a todas las páginas con un bucle for-->
        <?php for($x = 1; $x <= $paginas; $x++): ?> <?php if($x==$pagina): ?> <li class="active">
            <?php else: ?>
            <li>
                <?php endif; ?>
                <a href="index.php?controller=usuarios&action=listar&pagina=<?php echo e($x); ?>">
                    <?php echo e($x); ?></a>
            </li>
            <?php endfor; ?>
            <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante y el de ir a la última -->
            <?php if($pagina < $paginas): ?> <li>
                <a href="index.php?controller=usuarios&action=listar&pagina=<?php echo e($pagina+1); ?>">
                    <span aria-hidden="true">&gt;</span>
                </a>
                </li>
                <li>
                    <a href="index.php?controller=usuarios&action=listar&pagina=<?php echo e($paginas); ?>">
                        <span>&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
    </ul>
</nav>
<h5><em>Usuarios totales: <?php echo e($conteo); ?></em></h5>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/usuariosVer.blade.php ENDPATH**/ ?>