<?php

/**
 * hayModificacion: comprueba si la fecha pasada como parámetro se ha modificado, es decir,
 * si es distinta a la fecha del día en el que se usa esta función
 *
 * @param  mixed $fecha
 * @return boolean
 */
function hayModificacion($fecha)
{
    $fechaActual = new DateTime(date('Y-m-d'));
    $fechaDada = new DateTime($fecha);
    if ($fechaDada < $fechaActual || $fechaDada > $fechaActual) {
        return true;
    } else
        return false;
}
