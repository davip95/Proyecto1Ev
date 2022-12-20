<?php
require __DIR__ . '/../constantes.php';

use Jenssegers\Blade\Blade;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

// define('MODEL_PATH', __DIR__ . '/app/models/');
define('CACHE_PATH', APP_PATH . 'views/cache/');
// define('CTRL_PATH', __DIR__ . '/app/controllers/');
define('VIEW_PATH', __DIR__ . '/app/views/');
echo (CACHE_PATH);
include(__DIR__ . '/../../vendor/autoload.php');

$blade = new Blade(VIEW_PATH, CACHE_PATH);

//DIE(VIEW_PATH);