<?php
include("inicioVista.php");
// Defino constante de la carpeta de controladores
define('CONTROLLERS_FOLDER', "controllers/");

// Defino constante de controlador por defecto

define('DEFAULT_CONTROLLER', "baseDatos");

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

//Ya tenemos el controlador y la accion
//Formamos el nombre del fichero que contiene nuestro controlador
$controller = CONTROLLERS_FOLDER . $controller . "Control.php";

//Si la variable $controller es un fichero lo requerimos
if (is_file($controller))
    require_once($controller);
else
    die('El controlador no existe');

//Si la variable $action es una funcion la ejecutamos o detenemos el script
if (is_callable($action))
    $action();
else
    die('La accion no existe');
