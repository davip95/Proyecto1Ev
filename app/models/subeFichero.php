<?php

/**
 * subeFichero: funcion que sube un fichero y si la operación es correcta, devuelve la ruta del fichero subido, si no devuelve false
 *
 * @param  string $nombre
 * @return mixed
 */
function subeFichero($nombre)
{
    if (is_uploaded_file($_FILES[$nombre]['tmp_name'])) {
        // Uso la constante __DIR__ para indicar el directorio del script php en la cual guardaré el fichero subido
        $nombreDirectorio = __DIR__;
        $nombreFichero = $_FILES[$nombre]['name'];
        $nombreCompleto = $nombreDirectorio . '/' . $nombreFichero;
        // Muevo el archivo al path
        move_uploaded_file(
            $_FILES[$nombre]['tmp_name'],
            $nombreCompleto
        );
        return $nombreFichero;
    } else
        return false;
}
