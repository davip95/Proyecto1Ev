<?php

/**
 * validaFechaRealizacion: comprueba si la fecha de realización es posterior a la
 * fecha actual
 *
 * @param  mixed $fecha
 * @return boolean
 */
function validaFechaRealizacion($fecha)
{
    $fechaActual = new DateTime(date('Y-m-d'));
    $fechaDada = new DateTime($fecha);
    if ($fechaDada > $fechaActual) {
        return true;
    } else
        return false;
}
