<?php

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
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/baseDatosTareasModel.php');
    include(APP_PATH . 'models/varios.php');
    $ops = listarOperarios();
    $provs = listarProvincias();
    if ($_POST) {
        $error = validar($_POST['fechacreacion'], "crear");
        //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
        if ($error->HayErrores()) {
            echo $blade->render('tareaAñadir', [
                'error' => $error, 'operarios' => $ops, 'provincias' => $provs, 'sesion' => $sesion
            ]);
        } else {
            $datosTarea = $_POST;
            $tar = new Tareas();
            // Si se inserta correctamente la tarea, muestro la vista de los detalles de la tarea
            $idTarea = $tar->insertaTarea($datosTarea);
            if ($idTarea) {
                $tarea = $tar->getTarea($idTarea);
                echo $blade->render('tareaVerDetalles', ['tarea' => $tarea, 'sesion' => $sesion]);
            } else
                die('Error. La tarea no pudo insertarse.');
        }
    } else {
        // Creo un gestor de errores vacio para enviarlo a la plantilla de blade que necesita siempre una variable $error aunque no los haya
        $error = new GestorErrores('<span style="color:red">', '</span>');
        echo $blade->render('tareaAñadir', [
            'error' => $error, 'operarios' => $ops, 'provincias' => $provs, 'sesion' => $sesion
        ]);
    }
}

/**
 * validar: funcion que filtra todos los campos del formulario de la tarea y devuelve el objeto GestorErrores con 
 * los mensajes de error de cada campo si existen
 *
 * @param DateTime $fecha: parametro que será la fecha actual en el caso de creación de tarea o la fecha almacenada en el caso de modificación
 * @param string $tipo: si es modificar, indica que el filtrado es para una modificacion de la tarea. Si es crear, es para una creacion
 * @return object $error 
 */
function validar($fecha, $tipo)
{
    include_once(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . "models/filtroCodPostal.php");
    include(APP_PATH . "models/filtroCorreo.php");
    include(APP_PATH . "models/filtroDNI.php");
    include(APP_PATH . "models/filtroFechaRealizacion.php");
    include(APP_PATH . "models/filtroFechaSinModificar.php");
    include(APP_PATH . "models/filtroTelefono.php");
    include(APP_PATH . "models/filtroVacio.php");
    include(APP_PATH . "models/filtroRadio.php");
    $error = new GestorErrores('<span style="color:red">', '</span>');
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
        // Compruebo si no ha metido fecha de realización con el estado marcado en Realizada
        if (estaMarcado('estado') && $_POST['estado'] == 'R' && estaVacio($_POST['fechafin'])) {
            $error->AnotaError('fechafin', 'Debe introducir una fecha de realización si la tarea está Realizada (R).');
        }
        // Para una modificacion, compruebo que la fecha no sea distinta a la almacenada.
        // Para una creacion, compruebo que la fecha sea la del dia que se crea. 
        if ($tipo == 'modificar' && ($_POST['fechacreacion'] < $fecha || $_POST['fechacreacion'] > $fecha)) {
            $error->AnotaError('fechacreacion', 'La fecha de creación no se puede modificar.');
        } else if ($tipo == 'crear' && hayModificacion($fecha)) {
            $error->AnotaError('fechacreacion', 'La fecha de creación no se puede modificar.');
        }
        // Valido la fecha de realización si no está vacía
        if (!estaVacio($_POST['fechafin'])) {
            if (!validaFechaRealizacion($_POST['fechafin'], $fecha)) {
                $error->AnotaError('fechafin', 'La fecha de realización debe ser posterior a la de creación.');
            }
            // Compruebo si ha metido fecha de realización sin marcar el estado como Realizada
            else if (estaMarcado('estado') && $_POST['estado'] != 'R') {
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
    }
    return $error;
}

/**
 * listar: llama a las funciones conteoTareas() y getTareasPags() de las que obtiene las tareas y los datos
 * necesarios para la paginacion para mostrarlo en una tabla con Blade. Solo para Administradores.
 *
 * @return void
 */
function listar()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $tar = new Tareas();
    list($paginas, $conteo) = $tar->conteoTareas();
    list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPags();
    echo $blade->render('tareasVer', [
        'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
    ]);
}

/**
 * opLlistar: llama a las funciones conteoTareas() y getTareasPags() de las que obtiene las tareas y los datos
 * necesarios para la paginacion para mostrarlo en una tabla con Blade. Solo para Operarios.
 *
 * @return void
 */
function opListar()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $tar = new Tareas();
    list($paginas, $conteo) = $tar->conteoTareas();
    list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPags();
    echo $blade->render('tareasVerOp', [
        'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
    ]);
}

/**
 * ver: muestra la tarea cuyo id se obtiene de la url para ver todos sus detalles y poder completarla. Solo para Admins.
 *
 * @return void
 */
function ver()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $tarea = $tar->getTarea($idTarea);
    echo $blade->render('tareaVerDetalles', ['tarea' => $tarea, 'sesion' => $sesion]);
}

/**
 * opVer: muestra la tarea cuyo id se obtiene de la url para ver todos sus detalles y poder completarla. Solo para Ops.
 *
 * @return void
 */
function opVer()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $tarea = $tar->getTarea($idTarea);
    echo $blade->render('tareaVerDetallesOp', ['tarea' => $tarea, 'sesion' => $sesion]);
}

/**
 * verPendientes: muestra un listado de todas las tareas pendientes (estado = "P"). Solo Admins
 *
 * @return void
 */
function verPendientes()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $tar = new Tareas();
    list($paginas, $conteo) = $tar->conteoTareas('estado', '"P"');
    list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPags('estado', '"P"');
    echo $blade->render('tareasVerPendientes', [
        'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
    ]);
}

/**
 * opVerPendientes: muestra un listado de todas las tareas pendientes (estado = "P"). Solo Ops
 *
 * @return void
 */
function opVerPendientes()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $tar = new Tareas();
    list($paginas, $conteo) = $tar->conteoTareas('estado', '"P"');
    list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPags('estado', '"P"');
    echo $blade->render('tareasVerPendientesOp', [
        'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
    ]);
}

/**
 * editar: muestra los datos de la tarea cuyo id se obtiene de la url en el formulario para poder modificarla
 * si se modifica correctamente, se muestra la tarea ya modificada detalladamente
 * Si hay errores, vuelve a mostrar el formulario con los errores
 *
 * @return void
 */
function editar()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $tarea = $tar->getTarea($idTarea);
    $ops = listarOperarios();
    $provs = listarProvincias();
    $error = validar($tarea['fechacreacion'], 'modificar');
    if ($_POST) {
        //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
        if ($error->HayErrores()) {
            echo $blade->render('tareaModificar', [
                'tarea' => $tarea, 'error' => $error, 'operarios' => $ops, 'provincias' => $provs, 'sesion' => $sesion
            ]);
        } else {
            // Si se edita correctamente la tarea, muestro la vista de los detalles de la tarea
            $datosTarea = $_POST;
            if ($tar->editaTarea($datosTarea, $idTarea)) {
                $tarea = $tar->getTarea($idTarea);
                echo $blade->render('tareaVerDetalles', ['tarea' => $tarea, 'sesion' => $sesion]);
            } else
                die('Error. La tarea no pudo insertarse.');
        }
    } else {
        echo $blade->render('tareaModificar', [
            'tarea' => $tarea, 'error' => $error, 'operarios' => $ops, 'provincias' => $provs, 'sesion' => $sesion
        ]);
    }
}

/**
 * confirmaEliminar: muestra la tarea cuyo id se obtiene de la url para ver todos sus detalles y confirmar o no su borrado
 *
 * @return void
 */
function confirmaEliminar()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $tarea = $tar->getTarea($idTarea);
    echo $blade->render('tareaEliminar', ['tarea' => $tarea, 'sesion' => $sesion]);
}

/**
 * eliminarTarea: elimina los archivos asociados a la tarea y la tarea cuyo id se obtiene de la url y muestra mensaje confirmando el borrado
 *
 * @return void
 */
function eliminarTarea()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $eliminaArchivos = $tar->eliminaArchivos($idTarea);
    if ($eliminaArchivos) {
        $eliminada = $tar->eliminaTarea($idTarea);
        if ($eliminada) {
            echo $blade->render('tareaEliminada', ['idTarea' => $idTarea, 'sesion' => $sesion]);
        } else
            die('Error. La tarea no pudo eliminarse.');
    } else
        die('Error. Los archivos no pudieron eliminarse.');
}

/**
 * completaTarea: funcion que valida el formulario de completar tarea
 * Si pasa la validacion, modifica la tarea en la base de datos y la muestra en detalle
 * Si no, vuelve a mostrar el formulario con errores
 *
 * @return void
 */
function completaTarea()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/guardaArchivo.php");
    include(APP_PATH . "models/filtroVacio.php");
    include(APP_PATH . "models/filtroRadio.php");
    include(APP_PATH . "models/filtroFechaRealizacion.php");
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosTareasModel.php");
    $idTarea = $_GET["id"];
    $tar = new Tareas();
    $tarea = $tar->getTarea($idTarea);
    $error = new GestorErrores('<span style="color:red">', '</span>');
    if ($_POST) {
        // AQUI VALIDO EL ESTADO Y LA FECHA DE REALIZACION
        if (!estaMarcado('estado')) {
            $error->AnotaError('estado', 'Debe seleccionar un estado.');
        }
        if (estaMarcado('estado') && $_POST['estado'] != 'R') {
            $error->AnotaError('estado', 'Para completar la tarea, el estado debe ser Realizada (R).');
        }
        if (estaVacio($_POST['fechafin'])) {
            $error->AnotaError('fechafin', 'Debe introducir una fecha de realización para completar la tarea.');
        }
        if (!estaVacio($_POST['fechafin']) && !validaFechaRealizacion($_POST['fechafin'], $tarea['fechacreacion'])) {
            $error->AnotaError('fechafin', 'La fecha de realización debe ser posterior a la de creación.');
        }
        //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
        if ($error->HayErrores()) {
            echo $blade->render('tareaCompletar', [
                'tarea' => $tarea, 'error' => $error, 'sesion' => $sesion
            ]);
        } else {
            // Si se completa correctamente la tarea, guardo los archivos adjuntos si los hay y muestro la vista de los detalles de la tarea
            $datosTarea = $_POST;
            if ($_FILES['fichero']['name'] != '') {
                guardarArchivo($idTarea, 'fichero');
                $datosTarea['fichero'] = $idTarea . "_" . $_FILES['fichero']['name'];
            } else {
                $datosTarea['fichero'] = '';
            }
            if ($_FILES['foto']['name'] != '') {
                guardarArchivo($idTarea, 'foto');
                $datosTarea['foto'] = $idTarea . "_" . $_FILES['foto']['name'];
            } else {
                $datosTarea['foto'] = '';
            }
            if ($tar->completarTarea($datosTarea, $idTarea)) {
                $tarea = $tar->getTarea($idTarea);
                echo $blade->render('tareaVerDetalles', ['tarea' => $tarea, 'sesion' => $sesion]);
            } else
                die('Error. La tarea no pudo insertarse.');
        }
    } else {
        // Creo un gestor de errores vacio para enviarlo a la plantilla de blade que necesita siempre una variable $error aunque no los haya
        $error = new GestorErrores('<span style="color:red">', '</span>');
        echo $blade->render('tareaCompletar', [
            'tarea' => $tarea, 'error' => $error, 'sesion' => $sesion
        ]);
    }
}

/**
 * buscar: se filtra el formulario de busqueda. Si hay errores, se vuelve a mostrar con éstos y si no los hay, se prepara la 
 * consulta para visualizar las tareas resultado de la búsqueda. Solo para Admins.
 *
 * @return void
 */
function buscar()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/baseDatosTareasModel.php');
    include_once(APP_PATH . 'models/varios.php');
    $error = new GestorErrores('<span style="color:red">', '</span>');
    if ($_POST) {
        // Variable que me indica si cada fila de busqueda se ha rellenado correctamente
        $buscar = [false, false, false];
        // Valido que se ha seleccionado una opcion de radio
        if (!isset($_POST['oplogico'])) {
            $error->AnotaError('oplogico', 'Debe seleccionar un tipo de cumplimiento de condiciones.');
        }
        // Valido que ha seleccionado un campo al menos
        if (!isset($_POST['campo1']) && !isset($_POST['campo2']) && !isset($_POST['campo3'])) {
            $error->AnotaError('campo', 'Debe seleccionar un campo al menos.');
        }
        // Si se ha seleccionado un campo, compruebo que se ha seleccionado su criterio y que su valor no está vacío
        if (isset($_POST['campo1'])) {
            if (!isset($_POST['criterio1']) || empty($_POST['valor1'])) {
                $error->AnotaError('criteriovalor', 'Debe seleccionar un criterio y un valor si ha seleccionado un campo.');
            }
            if (isset($_POST['criterio1']) && !empty($_POST['valor1'])) {
                // Compruebo que el valor introducido es numérico
                if (is_numeric($_POST['valor1']))
                    $buscar[0] = true;
                else
                    $error->AnotaError('valor', 'El valor introducido debe ser un número');
            }
        }
        if (isset($_POST['campo2'])) {
            if (!isset($_POST['criterio2']) || empty($_POST['valor2'])) {
                $error->AnotaError('criteriovalor', 'Debe seleccionar un criterio y un valor si ha seleccionado un campo.');
            }
            if (isset($_POST['criterio2']) && !empty($_POST['valor2'])) {
                // Compruebo que el valor introducido es numérico
                if (is_numeric($_POST['valor2']))
                    $buscar[1] = true;
                else
                    $error->AnotaError('valor', 'El valor introducido debe ser un número');
            }
        }
        if (isset($_POST['campo3'])) {
            if (!isset($_POST['criterio3']) || empty($_POST['valor3'])) {
                $error->AnotaError('criteriovalor', 'Debe seleccionar un criterio y un valor si ha seleccionado un campo.');
            }
            if (isset($_POST['criterio3']) && !empty($_POST['valor3'])) {
                // Compruebo que el valor introducido es numérico
                if (is_numeric($_POST['valor3']))
                    $buscar[2] = true;
                else
                    $error->AnotaError('valor', 'El valor introducido debe ser un número');
            }
        }
        //Si hay algún error, muestro de nuevo el formulario con los mensajes de error correspondientes
        if ($error->HayErrores()) {
            echo $blade->render('tareasBuscar', ['error' => $error, 'sesion' => $sesion]);
        } else {
            // Si no hay errores, genero la consulta y muestro los resultados de busqueda
            // Preparo la consulta de la base de datos
            $consulta = "SELECT * FROM tareas WHERE ";
            $consultaConteo = "SELECT count(*) AS conteo FROM tareas WHERE ";
            // Hay 7 combinaciones posibles de campos seleccionados como filtros. A continuacion monto la consulta para cada combinacion
            if ($buscar[0]) {
                // La primera opcion rellena únicamente
                $consulta .= $_POST['campo1'] . $_POST['criterio1'] . $_POST["valor1"];
                $consultaConteo .= $_POST['campo1'] . $_POST['criterio1'] . $_POST["valor1"];
                if ($buscar[1]) {
                    if ($buscar[2]) {
                        // Las tres opciones rellenas
                        $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"] . " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                        $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"] . " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                    } else {
                        // Las dos primeras opciones rellenas
                        $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                        $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                    }
                } else if ($buscar[2]) {
                    // La primera y la ultima opcion rellenas
                    $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                    $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                }
            } else if ($buscar[1]) {
                // La segunda opcion rellena únicamente
                $consulta .= $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                $consultaConteo .= $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                if ($buscar[3]) {
                    // La segunda y la última opcion rellenas
                    $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                    $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                }
            } else if ($buscar[3]) {
                // La última opcion rellena únicamente
                $consulta .= $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                $consultaConteo .= $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
            }
            $tar = new Tareas();
            list($paginas, $conteo) = $tar->conteoTareasFiltro($consultaConteo);
            list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPagsFiltro($consulta);
            echo $blade->render('tareasVerBuscadas', [
                'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
                'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
            ]);
        }
    } else {
        echo $blade->render('tareasBuscar', ['error' => $error, 'sesion' => $sesion]);
    }
}

/**
 * opBuscar: se filtra el formulario de busqueda. Si hay errores, se vuelve a mostrar con éstos y si no los hay, se prepara la 
 * consulta para visualizar las tareas resultado de la búsqueda. Solo para Ops.
 *
 * @return void
 */
function opBuscar()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/baseDatosTareasModel.php');
    include_once(APP_PATH . 'models/varios.php');
    $error = new GestorErrores('<span style="color:red">', '</span>');
    if ($_POST) {
        // Variable que me indica si cada fila de busqueda se ha rellenado correctamente
        $buscar = [false, false, false];
        // Valido que se ha seleccionado una opcion de radio
        if (!isset($_POST['oplogico'])) {
            $error->AnotaError('oplogico', 'Debe seleccionar un tipo de cumplimiento de condiciones.');
        }
        // Valido que ha seleccionado un campo al menos
        if (!isset($_POST['campo1']) && !isset($_POST['campo2']) && !isset($_POST['campo3'])) {
            $error->AnotaError('campo', 'Debe seleccionar un campo al menos.');
        }
        // Si se ha seleccionado un campo, compruebo que se ha seleccionado su criterio y que su valor no está vacío
        if (isset($_POST['campo1'])) {
            if (!isset($_POST['criterio1']) || empty($_POST['valor1'])) {
                $error->AnotaError('criteriovalor', 'Debe seleccionar un criterio y un valor si ha seleccionado un campo.');
            }
            if (isset($_POST['criterio1']) && !empty($_POST['valor1'])) {
                // Compruebo que el valor introducido es numérico
                if (is_numeric($_POST['valor1']))
                    $buscar[0] = true;
                else
                    $error->AnotaError('valor', 'El valor introducido debe ser un número');
            }
        }
        if (isset($_POST['campo2'])) {
            if (!isset($_POST['criterio2']) || empty($_POST['valor2'])) {
                $error->AnotaError('criteriovalor', 'Debe seleccionar un criterio y un valor si ha seleccionado un campo.');
            }
            if (isset($_POST['criterio2']) && !empty($_POST['valor2'])) {
                // Compruebo que el valor introducido es numérico
                if (is_numeric($_POST['valor2']))
                    $buscar[1] = true;
                else
                    $error->AnotaError('valor', 'El valor introducido debe ser un número');
            }
        }
        if (isset($_POST['campo3'])) {
            if (!isset($_POST['criterio3']) || empty($_POST['valor3'])) {
                $error->AnotaError('criteriovalor', 'Debe seleccionar un criterio y un valor si ha seleccionado un campo.');
            }
            if (isset($_POST['criterio3']) && !empty($_POST['valor3'])) {
                // Compruebo que el valor introducido es numérico
                if (is_numeric($_POST['valor3']))
                    $buscar[2] = true;
                else
                    $error->AnotaError('valor', 'El valor introducido debe ser un número');
            }
        }
        //Si hay algún error, muestro de nuevo el formulario con los mensajes de error correspondientes
        if ($error->HayErrores()) {
            echo $blade->render('tareasBuscarOp', ['error' => $error, 'sesion' => $sesion]);
        } else {
            // Si no hay errores, genero la consulta y muestro los resultados de busqueda
            // Preparo la consulta de la base de datos
            $consulta = "SELECT * FROM tareas WHERE ";
            $consultaConteo = "SELECT count(*) AS conteo FROM tareas WHERE ";
            // Hay 7 combinaciones posibles de campos seleccionados como filtros. A continuacion monto la consulta para cada combinacion
            if ($buscar[0]) {
                // La primera opcion rellena únicamente
                $consulta .= $_POST['campo1'] . $_POST['criterio1'] . $_POST["valor1"];
                $consultaConteo .= $_POST['campo1'] . $_POST['criterio1'] . $_POST["valor1"];
                if ($buscar[1]) {
                    if ($buscar[2]) {
                        // Las tres opciones rellenas
                        $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"] . " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                        $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"] . " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                    } else {
                        // Las dos primeras opciones rellenas
                        $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                        $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                    }
                } else if ($buscar[2]) {
                    // La primera y la ultima opcion rellenas
                    $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                    $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                }
            } else if ($buscar[1]) {
                // La segunda opcion rellena únicamente
                $consulta .= $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                $consultaConteo .= $_POST['campo2'] . $_POST['criterio2'] . $_POST["valor2"];
                if ($buscar[3]) {
                    // La segunda y la última opcion rellenas
                    $consulta .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                    $consultaConteo .= " " . $_POST['oplogico'] . " " . $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                }
            } else if ($buscar[3]) {
                // La última opcion rellena únicamente
                $consulta .= $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
                $consultaConteo .= $_POST['campo3'] . $_POST['criterio3'] . $_POST["valor3"];
            }
            $tar = new Tareas();
            list($paginas, $conteo) = $tar->conteoTareasFiltro($consultaConteo);
            list($tareas, $tareasPorPagina, $pagina) = $tar->getTareasPagsFiltro($consulta);
            echo $blade->render('tareasVerBuscadasOp', [
                'tareas' => $tareas, 'tareasPorPagina' => $tareasPorPagina, 'pagina' => $pagina,
                'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
            ]);
        }
    } else {
        echo $blade->render('tareasBuscarOp', ['error' => $error, 'sesion' => $sesion]);
    }
}
