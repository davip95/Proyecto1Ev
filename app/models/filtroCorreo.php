<?php

/**
 * validaCorreo : comprueba que una dirección de correo electrónico es válida. Para
 * ello, se validan direcciones de correo electrónico con la sintaxis addr-spec
 * del » RFC 822, con la excepción de no admitir el plegamiento de comentarios y
 * dominios con espacios en blanco no son compatibles.
 *
 * @param  mixed $correo
 * @return boolean
 */
function validaCorreo($correo)
{
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else
        return false;
}
