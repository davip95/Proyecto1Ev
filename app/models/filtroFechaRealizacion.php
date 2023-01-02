<?php

/**
 * validaFechaRealizacion: comprueba si la fecha de realización es posterior a la
 * fecha de creacion
 *
 * @param  mixed $fecha
 * @param  mixed $fechaCreacion
 * @return boolean
 */
function validaFechaRealizacion($fecha, $fechaCreacion)
{
    $fechaCreada = new DateTime($fechaCreacion);
    $fechaDada = new DateTime($fecha);
    if ($fechaDada > $fechaCreada) {
        return true;
    } else
        return false;
}
