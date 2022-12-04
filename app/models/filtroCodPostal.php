<?php

/**
 * validaCodPostal : comprueba si el codigo postal está entre 01000 y 52999
 *
 * @param  mixed $codpostal
 * @return boolean
 */
function validaCodPostal($codpostal)
{
    if (preg_match('/^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/', $codpostal)) {
        return true;
    } else
        return false;
}
