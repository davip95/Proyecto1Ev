<?php

/**
 * guardarArchivo: funcion que guarda los archivos adjuntos subidos en la carpeta archivos con el id de su tarea al comienzo del nombre
 *
 * @param  int $idTarea
 * @param  string $nombre
 * @return void
 */
function guardarArchivo($idTarea, $nombre)
{
    $nombreDirectorio = __DIR__ . "/../archivos";
    $nombreFichero = $idTarea . "_" . $_FILES[$nombre]['name'];
    $nombreCompleto = $nombreDirectorio . '/' . $nombreFichero;
    if (is_uploaded_file($_FILES[$nombre]['tmp_name']))
        move_uploaded_file($_FILES[$nombre]['tmp_name'], $nombreCompleto);
}
