<?php
require("controllers/baseDatosControl.php");

// Defino constante de la carpeta de controladores
define('CONTROLLERS_FOLDER', "controllers/");

// Defino constante de controlador por defecto

define('DEFAULT_CONTROLLER', "tareas");

// Defino constante de la acción por defecto

define('DEFAULT_ACTION', "listar");

// Obtenemos el controlador.
// Si el usuario no lo introduce, seleccionamos el de por defecto.
$controlador = DEFAULT_CONTROLLER;
if (!empty($_GET['controller']))
    $controlador = $_GET['controller'];

// Obtenemos la acción seleccionada.
// Si el usuario no la introduce, seleccionamos la de por defecto.
$accion = DEFAULT_ACTION;
if (!empty($_GET['action']))
    $action = $_GET['action'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <h1>Bunglebuild S.L.</h1>
    <h3>Gestor de Incidencias/Tareas</h3>
    <button>Ver lista</button>
    <br><br>
    <button>Añadir</button>
    <br><br>
    <button>Modificar</button>
    <br><br>
    <button>Eliminar</button>
    <br><br>
    <button>Cambiar estado</button>
    <br><br>
    <button>Completar</button>
    <br><br>
    <button>Buscar</button>
</body>

</html>