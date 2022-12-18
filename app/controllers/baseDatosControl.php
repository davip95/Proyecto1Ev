<?php

/**
 * listar: genera un array con cada operario y su id para listarlos en el select del formulario
 * 
 * @return array
 */
function listar()
{
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $usuarios = new Usuarios();
    return $operarios = $usuarios->getOperarios();
}
