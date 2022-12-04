<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/css/nuevaTarea.css">
</head>

<body>
    <?php
    include("../models/utilsforms.php");
    $operarios = [1 => "Pepe", 2 => "Manolo", 3 => "Ana", 4 => "Antonio"];
    ?>
    <h1>Tarea</h1>
    <div class="formulario">
        <form enctype="multipart/form-data" action="../controllers/validaTarea.php" method="POST">
            <div class="padrecolumnas">
                <div class="columnacampos">
                    <label class="form-label">NIF o CIF</label><br>
                    <input type="text" name="dni" class="form-control form-control-sm" value="<?= isset($_POST['dni']) ? $_POST['dni'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('dni') ?><br>
                    <label class="form-label">Nombre</label><br>
                    <input type="text" name="nombre" class="form-control form-control-sm" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('nombre') ?><br>
                    <label class="form-label">Apellidos</label><br>
                    <input type="text" name="apellidos" class="form-control form-control-sm" value="<?= isset($_POST['apellidos']) ? $_POST['apellidos'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('apellidos') ?><br>
                    <label class="form-label">Teléfono contacto</label><br>
                    <input type="text" name="telefono" class="form-control form-control-sm" value="<?= isset($_POST['telefono']) ? $_POST['telefono'] : '' ?>">
                    <div class="form-text info">Debe ser de España. Puede separar los dígitos con espacio o guión.</div><br>
                    <?= $error->ErrorFormateado('telefono') ?><br>
                    <label class="form-label">Descripción</label><br>
                    <input type="text" name="descripcion" class="form-control form-control-sm" value="<?= isset($_POST['descripcion']) ? $_POST['descripcion'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('descripcion') ?><br>
                    <label class="form-label">Correo electrónico</label><br>
                    <input type="text" name="correo" class="form-control form-control-sm" value="<?= isset($_POST['correo']) ? $_POST['correo'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('correo') ?>
                </div>
                <div class="columnacampos">
                    <label class="form-label">Dirección</label><br>
                    <input type="text" name="direccion" class="form-control form-control-sm" value="<?= isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('direccion') ?><br>
                    <label class="form-label">Población</label><br>
                    <input type="text" name="poblacion" class="form-control form-control-sm" value="<?= isset($_POST['poblacion']) ? $_POST['poblacion'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('poblacion') ?><br>
                    <label class="form-label">Código Postal</label><br>
                    <input type="text" name="codpostal" class="form-control form-control-sm" value="<?= isset($_POST['codpostal']) ? $_POST['codpostal'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('codpostal') ?><br>
                    <label class="form-label">Provincia</label><br>
                    <!-- //CreaSelect("provincia",) <br> -->
                    <!--  $error->ErrorFormateado('provincia') ?> -->
                    <label class="form-label">Estado</label><br>
                    <input type="text" name="estado" class="form-control form-control-sm" value="<?= isset($_POST['estado']) ? $_POST['estado'] : '' ?>"><br>

                    <label class="form-label">Fecha de creación de tarea</label><br>
                    <input type="date" name="fechacreacion" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>"><br>
                    <?= $error->ErrorFormateado('fechacreacion') ?>
                </div>
                <div class="columnacampos">
                    <label class="form-label">Operario encargado</label><br>
                    <?= CreaSelect("operario", $operarios) ?><br>

                    <label class="form-label">Fecha de realización</label><br>
                    <input type="date" name="fechafin" class="form-control form-control-sm" value="<?= isset($_POST['fechafin']) ? $_POST['fechafin'] : '' ?>"><br>
                    <?= $error->ErrorFormateado('fechafin') ?><br>
                    <label class="form-label">Anotaciones anteriores</label><br>
                    <textarea name="anotaantes" class="form-control form-control-sm" cols="10" rows="1" value="<?= isset($_POST['anotaantes']) ? $_POST['anotaantes'] : '' ?>"></textarea><br>

                    <label class="form-label">Anotaciones posteriores</label><br>
                    <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1" value="<?= isset($_POST['anotapost']) ? $_POST['anotapost'] : '' ?>"></textarea><br>

                    <label class="form-label">Fichero resumen</label><br>
                    <input type="file" name="ficheroresumen" class="form-control form-control-sm" id="formFileSm"><br>

                    <label class="form-label">Fotos del trabajo</label><br>
                    <input type="file" name="fotos" class="form-control form-control-sm" id="formFileMultiple" multiple><br>

                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Añadir Tarea">
        </form>
    </div>
</body>

</html>