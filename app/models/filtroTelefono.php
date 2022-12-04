<?php

/**
 * validaTelefono: comprueba si el número introducido tiene como prefijo el código de España,
 * si empieza por 6 o 7 y si tiene 9 dígitos sin contar el prefijo. Además, comprueba si se 
 * usa como separadores solamente espacios o guiones
 *
 * @param  mixed $telefono
 * @return boolean
 */
function validaTelefono($telefono)
{
    if (preg_match('/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/', $telefono)) {
        return true;
    } else
        return false;
}
