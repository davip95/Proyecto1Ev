<?php


/**
 * estaMarcado: comprueba si un input del tipo radio está marcado
 *
 * @param  mixed $campo
 * @return boolean
 */
function estaMarcado($campo)
{
    if (isset($_POST[$campo])) {
        return true;
    } else
        return false;
}
