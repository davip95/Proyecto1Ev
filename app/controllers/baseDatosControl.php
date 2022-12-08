<?php

/**
 * listar: genera un array con cada operario y su id para listarlos en el select del formulario
 * 
 * @return void
 */
function listar()
{
    require("../models/baseDatosUsuariosModel.php");
    $usuarios = new Usuarios();
    $operarios = $usuarios->getOperarios();
    include("tareasControl.php");
}
/*require("../models/baseDatosUsuarios.php");
$usuarios = new Usuarios();
$operarios = $usuarios->getOperarios();
include("tareasControl.php");*/
