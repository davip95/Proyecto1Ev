<?php

require_once("baseDatosControl.php");

//include(__DIR__ . "/models/GestorErrores.php");
/*include(__DIR__ . "/models/filtroCodPostal.php");
include(__DIR__ . "/models/filtroCorreo.php");
include(__DIR__ . "/models/filtroDNI.php");
include(__DIR__ . "/models/filtroFechaRealizacion.php");
include(__DIR__ . "/models/filtroFechaSinModificar.php");
include(__DIR__ . "/models/filtroTelefono.php");
include(__DIR__ . "/models/filtroVacio.php");
include(__DIR__ . "/models/filtroRadio.php");*/


/**
 * iniciar: muestra la vista inicial de la aplicación
 *
 * @return void
 */
function iniciar()
{
    include(APP_PATH . "views/inicioVista.php");
}


/**
 * crear: funcion que valida el formulario de creación de nueva tarea
 * Si pasa la validación, inserta la tarea en la base de datos
 * Si no la pasa, vuelve a mostrar el formulario con los errores
 *
 * @return void
 */
function crear()
{
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . "models/filtroCodPostal.php");
    include(APP_PATH . "models/filtroCorreo.php");
    include(APP_PATH . "models/filtroDNI.php");
    include(APP_PATH . "models/filtroFechaRealizacion.php");
    include(APP_PATH . "models/filtroFechaSinModificar.php");
    include(APP_PATH . "models/filtroTelefono.php");
    include(APP_PATH . "models/filtroVacio.php");
    include(APP_PATH . "models/filtroRadio.php");
    $error = new GestorErrores('<span style="color:red">', '</span>');
    listar();
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
        //COMPROBAR TAMBIEN SI NO HA SELECCIONADO OPERARIO
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
            include(APP_PATH . '/views/tareaAñadir.php');
        } else {
            //AQUI IRÍA UN INCLUDE AL ARCHIVO DE BD QUE HAGA EL INSERT
            include('');
        }
    } else {
        include(APP_PATH . '/views/tareaAñadir.php');
    }
}
