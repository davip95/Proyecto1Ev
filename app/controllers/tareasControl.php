<?php
/* ESTA FUNCION DE INICIAR NO SE USARÁ PERO TAL VEZ MODIFIQUE SU CONTENIDO Y SE USE DESPUES DE HACER EL LOGIN */
// /**
//  * iniciar: muestra la vista inicial de la aplicación
//  *
//  * @return void
//  */
// function iniciar()
// {
//     include(APP_PATH . 'models/varios.php');
//     echo $blade->render('inicioVista');
// }

/**
 * listarOperarios: genera un array con cada operario y su id para listarlos en el select del formulario
 * 
 * @return array
 */
function listarOperarios()
{
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $usuarios = new Usuarios();
    $operarios = $usuarios->getOperarios();
    return $operarios;
}

/**
 * listarProvincias: genera un array con cada provincia y su codigo para listarlos en el select del formulario
 * 
 * @return array
 */
function listarProvincias()
{
    require(APP_PATH . "models/baseDatosProvComModel.php");
    $prov = new ProvCom();
    $provincias = $prov->getProvincias();
    return $provincias;
}


/**
 * crear: funcion que valida el formulario de creación de nueva tarea
 * Si pasa la validación, inserta la tarea en la base de datos y muestra la tarea en detalle
 * Si no la pasa, vuelve a mostrar el formulario con los errores
 *
 * @return void
 */
function crear()
{
    include(APP_PATH . 'models/baseDatosTareasModel.php');
    include(APP_PATH . 'models/varios.php');
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
    $ops = listarOperarios();
    $provs = listarProvincias();
    if ($_POST) {
        if (estaVacio($_POST['dni'])) {
            $error->AnotaError('dni', 'El DNI no puede estar vacío.');
        }
        if (!estaVacio($_POST['dni']) && !validDniCifNie($_POST['dni'])) {
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
        if (estaVacio($_POST['direccion'])) {
            $error->AnotaError('direccion', 'La direccion no puede estar vacía.');
        }
        if (estaVacio($_POST['poblacion'])) {
            $error->AnotaError('poblacion', 'La poblacion no puede estar vacía.');
        }
        if (!isset($_POST['provincia'])) {
            $error->AnotaError('provincia', 'Debe seleccionar una provincia.');
        }
        if (!isset($_POST['operario'])) {
            $error->AnotaError('operario', 'Debe seleccionar un operario.');
        }
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
            // Compruebo si ha metido fecha de realización sin marcar el estado como Realizada
            if (estaMarcado('estado') && $_POST['estado'] != 'R') {
                $error->AnotaError('estado', 'Para introducir una fecha de realización el estado debe ser Realizada (R).');
            }
        }
        if (estaVacio($_POST['codpostal'])) {
            $error->AnotaError('codpostal', 'El código postal no puede estar vacío.');
        }
        if (!estaVacio($_POST['codpostal']) && !validaCodPostal($_POST['codpostal'])) {
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
            //var_dump($_POST);
            echo $blade->render('tareaAñadir', [
                'error' => $error, 'operarios' => $ops, 'provincias' => $provs
            ]);
        } else {
            $datosTarea = $_POST;
            $tar = new Tareas();
            // Si se inserta correctamente la tarea, muestro la vista de los detalles de la tarea
            $idTarea = $tar->insertaTarea($datosTarea);
            if ($idTarea) {
                $tarea = $tar->getTarea($idTarea);
                echo $blade->render('tareasVerDetalles', ['tarea' => $tarea,]);
            } else
                die('Error. La tarea no pudo insertarse.');;
        }
    } else {
        echo $blade->render('tareaAñadir', [
            'error' => $error, 'operarios' => $ops, 'provincias' => $provs
        ]);
    }
}

/**
 * listar: llama a las funciones conteoTareas() y getTareasPags() de las que obtiene las tareas y los datos
 * necesarios para la paginacion para mostrarlo en una tabla con Blade
 *
 * @return void
 */
function listar()
{
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $tar = new Tareas();
    list($paginas, $conteo) = $tar->conteoTareas();
    list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPags();
    echo $blade->render('tareasVer', [
        'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo
    ]);
}

/**
 * ver: muestra la tarea cuyo id se obtiene de la url para ver todos sus detalles y poder completarla
 *
 * @return void
 */
function ver()
{
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $tarea = $tar->getTarea($idTarea);
    echo $blade->render('tareasVerDetalles', ['tarea' => $tarea,]);
}

/**
 * verPendientes: muestra un listado de todas las tareas pendientes (estado = "P")
 *
 * @return void
 */
function verPendientes()
{
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $tar = new Tareas();
    list($paginas, $conteo) = $tar->conteoTareas('estado', '"P"');
    list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPags('estado', '"P"');
    echo $blade->render('tareasVerPendientes', [
        'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo
    ]);
}
