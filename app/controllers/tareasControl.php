<?php

require_once("baseDatosControl.php");

include("../models/GestorErrores.php");
include("../models/filtroCodPostal.php");
include("../models/filtroCorreo.php");
include("../models/filtroDNI.php");
include("../models/filtroFechaRealizacion.php");
include("../models/filtroFechaSinModificar.php");
include("../models/filtroTelefono.php");
include("../models/filtroVacio.php");
include("../models/filtroRadio.php");

$error = new GestorErrores('<span style="color:red">', '</span>');

if ($_POST) {
    if (!validDniCifNie($_POST['dni'])) {
        $error->AnotaError('dni', 'El DNI introducido no es válido.');
    }
    if (estaVacio($_POST['nombre'])) {
        $error->AnotaError('nombre', 'El nombre no puede estar vacío.');
    }
    if (estaVacio($_POST['apellidos'])) {
        $error->AnotaError('apellidos', 'Los apellidos no pueden estar vacíos.');
    }
    if (estaVacio($_POST['descripcion'])) {
        $error->AnotaError('descripcion', 'La descripción no puede estar vacía.');
    }
    /*if (estaVacio($_POST['provincia'])) {
        $error->AnotaError('provincia', 'Debe seleccionar una provincia.');
    }*/
    if (estaVacio($_POST['descripcion'])) {
        $error->AnotaError('descripcion', 'La descripción no puede estar vacía.');
    }
    if (!estaMarcado('estado')) {
        $error->AnotaError('estado', 'Debe seleccionar un estado.');
    }
    if (hayModificacion($_POST['fechacreacion'])) {
        $error->AnotaError('fechacreacion', 'La fecha de creación no se puede modificar. Debe ser la de hoy.');
    }
    // Valido la fecha de realización si no está vacía
    if (!estaVacio($_POST['fechafin'])) {
        if (!validaFechaRealizacion($_POST['fechafin'])) {
            $error->AnotaError('fechafin', 'La fecha de realización debe ser posterior a la actual.');
        }
    }
    if (!validaCodPostal($_POST['codpostal'])) {
        $error->AnotaError('codpostal', 'El código postal debe tener un formato válido.');
    }
    //  Compruebo si el telefono está vacío, sino compruebo si es válido
    if (!estaVacio($_POST['telefono'])) {
        if (!validaTelefono($_POST['telefono'])) {
            $error->AnotaError('telefono', 'El teléfono debe tener un formato válido.');
        }
    } else {
        $error->AnotaError('telefono', 'El teléfono no puede estar vacío.');
    }
    // Compruebo si el correo está vacío, sino compruebo si es válido
    if (!estaVacio($_POST['correo'])) {
        if (!validaCorreo($_POST['correo'])) {
            $error->AnotaError('correo', 'El correo debe tener un formato válido.');
        }
    } else {
        $error->AnotaError('correo', 'El correo no puede estar vacío.');
    }
    //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
    if ($error->HayErrores()) {
        include('../views/tareaAñadir.php');
    } else {
        //AQUI IRÍA UN INCLUDE AL ARCHIVO DE BD QUE HAGA EL INSERT
        include('');
    }
} else {
    include('../views/tareaAñadir.php');
}
