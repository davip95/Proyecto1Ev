<?php
// Defino la URL en la que se encuentra la aplicación
define('BASE_URL', 'http://localhost:3000/Users/david/Desktop/FP/2º%20DAW%20(Curso%2022-23)/Desarrollo%20Web%20en%20Entorno%20Servidor/Proyecto1Ev/app/');

// Defino la ruta raiz
define('APP_PATH', __DIR__ . "/");

// Defino constante de la carpeta de controladores
define('CONTROLLERS_FOLDER', APP_PATH . "controllers/");

// Defino constante de controlador por defecto
define('DEFAULT_CONTROLLER', "login");

// Defino constante de la acción por defecto
define('DEFAULT_ACTION', "login");

// Defino la ruta de la carpeta cache para Blade
define('CACHE_PATH', APP_PATH . 'views/cache/');

// Defino la ruta de la carpeta views para Blade
define('VIEW_PATH', APP_PATH . 'views/');
