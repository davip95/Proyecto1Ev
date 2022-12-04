<?php

/**
 * estaVacio: comprueba si el campo pasado como parámetro está vacío
 *
 * @param  mixed $campo
 * @return boolean
 */
function estaVacio($campo)
{
    if (empty($campo)) {
        return true;
    } else
        return false;
}
