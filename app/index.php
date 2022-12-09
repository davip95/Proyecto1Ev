<?php
// Defino la URL en la que se encuentra la aplicación
define('BASE_URL', 'http://localhost:3000/Users/david/Desktop/FP/2º%20DAW%20(Curso%2022-23)/Desarrollo%20Web%20en%20Entorno%20Servidor/Proyecto1Ev/app/');

// Defino la ruta raiz
define('APP_PATH', __DIR__ . "/");

// Defino constante de la carpeta de controladores
define('CONTROLLERS_FOLDER', APP_PATH . "controllers/");

// Defino constante de controlador por defecto

define('DEFAULT_CONTROLLER', "tareas");

// Defino constante de la acción por defecto

define('DEFAULT_ACTION', "iniciar");

// Obtenemos el controlador.
// Si el usuario no lo introduce, seleccionamos el de por defecto.
$controller = DEFAULT_CONTROLLER;
if (!empty($_GET['controller']))
    $controller = $_GET['controller'];

// Obtenemos la acción seleccionada.
// Si el usuario no la introduce, seleccionamos la de por defecto.
$action = DEFAULT_ACTION;
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
