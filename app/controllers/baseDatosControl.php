<?php

/**
 * listaOperarios: genera un array con cada operario y su id para listarlos en el select del formulario
 * 
 * @return void
 */
function listaOperarios()
{
    require("../models/baseDatosUsuarios.php");


    $usuarios = new Usuarios();
    $operarios = $usuarios->getOperarios();
    var_dump($operarios);

    include("validaTarea.php");
}
