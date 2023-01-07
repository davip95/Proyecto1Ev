<?php

/**
 * ver: muestra el usuario cuyo id se obtiene de la url para ver todos sus detalles y poder eliminarlo o cambiar nombre o clave. Solo para Admins.
 *
 * @return void
 */
function ver()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $idUsuario = $_GET["id"];
    $user = new Usuarios();
    $usuario = $user->getUsuario($idUsuario);
    echo $blade->render('usuarioVerDetalles', ['usuario' => $usuario, 'sesion' => $sesion]);
}

/**
 * opVer: muestra el usuario cuyo id se obtiene de la url para ver todos sus detalles y poder eliminarlo o cambiar nombre o clave. Solo para Ops.
 *
 * @return void
 */
function opVer()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $idUsuario = $_GET["id"];
    // Si la id de usuario de la url no coincide con la id de usuario de la sesion, muestro la pantalla de login y finalizo la sesion
    if ($idUsuario != $sesion['idusuario']) {
        session_unset(); // Libera todas las variables de sesión
        session_destroy(); // Destruimos la sesión
        header('Location: ' . BASE_URL . 'index.php?controller=login&action=login');
        // Finalizamos script
        exit();
    } else {
        $user = new Usuarios();
        $usuario = $user->getUsuario($idUsuario);
        echo $blade->render('usuarioVerDetallesOp', ['usuario' => $usuario, 'sesion' => $sesion]);
    }
}

/**
 * listar: llama a las funciones conteoUsuarios() y getUsuariosPags() de las que obtiene los usuarios y los datos
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
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $user = new Usuarios();
    list($paginas, $conteo) = $user->conteoUsuarios();
    list($usuarios, $usuariosPorPagina, $pagina) = $user->getUsuariosPags();
    echo $blade->render('usuariosVer', [
        'usuarios' => $usuarios, 'usuariosPorPagina' => $usuariosPorPagina, 'pagina' => $pagina,
        'paginas' => $paginas, 'conteo' => $conteo, 'sesion' => $sesion
    ]);
}

/**
 * validaCambioNombrePass: funcion que filtra todos los campos del formulario de cambio de nombre/clave y devuelve el objeto GestorErrores con 
 * los mensajes de error de cada campo si existen
 *
 * @return object
 */
function validaCambioNombrePass()
{
    include_once(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . "models/filtroVacio.php");
    $error = new GestorErrores('<span style="color:red">', '</span>');
    if ($_POST) {
        // Compruebo si ha introducido un nuevo nombre y si este es una cadena alfanumérica
        if (!estaVacio($_POST['nuevonombre']) && !ctype_alnum($_POST['nuevonombre'])) {
            $error->AnotaError('nuevonombre', 'El nombre nuevo sólo puede estar compuesto de letras y números.');
        }
        // Compruebo que las contraseñas coinciden
        if ($_POST['nuevapass'] !== $_POST['nuevapassrep']) {
            $error->AnotaError('nuevapass', 'Las contraseñas no coinciden.');
        }
        // Compruebo si estan vacíos todos los campos
        if (empty($_POST['nuevonombre']) && empty($_POST['nuevapass']) && empty($_POST['nuevapassrep'])) {
            $error->AnotaError('editar', 'Debe rellenar el nombre y/o los campos de nueva contraseña.');
        }
    }
    return $error;
}

/**
 * cambiaNombrePass: llama a la validacion del formulario para el cambio de datos de usuario. Si no hay errores, comprueba que datos
 * quiere cambiar y hace el update. Si hay errores, muestra de nuevo el formulario. Si hace bien el update, muestra los detalles del
 * usuario actualizado. Solo para Admins.
 *
 * @return void
 */
function cambiaNombrePass()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/baseDatosUsuariosModel.php');
    include(APP_PATH . 'models/varios.php');
    $idUsuario = $_GET["id"];
    $user = new Usuarios();
    $usuario = $user->getUsuario($idUsuario);
    $error = validaCambioNombrePass();
    if ($_POST) {
        //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
        if ($error->HayErrores()) {
            echo $blade->render('usuarioModificar', [
                'usuario' => $usuario, 'error' => $error, 'sesion' => $sesion
            ]);
        } else {
            // Compruebo ahora si solo quiere cambiar el nombre, solo la contraseña o ambos
            if (empty($_POST['nuevonombre'])) {
                // Solo quiere cambiar la contraseña
                $datosUsuario = "pass='" . $_POST['nuevapass'] . "'";
            }
            if (empty($_POST['nuevapass']) && empty($_POST['nuevapassrep'])) {
                // Solo quiere cambiar el nombre
                $datosUsuario = "nombre='" . $_POST['nuevonombre'] . "'";
            }
            if (!empty($_POST['nuevonombre']) && !empty($_POST['nuevapass']) && !empty($_POST['nuevapassrep'])) {
                // Quiere cambiar nombre y contraseña
                $datosUsuario = "nombre='" . $_POST['nuevonombre'] . "', pass='" . $_POST['nuevapass'] . "'";
            }
            // Si se edita correctamente el usuario, muestro la vista de los detalles del usuario
            if ($user->cambiaUsuario($datosUsuario, $idUsuario)) {
                $usuario = $user->getUsuario($idUsuario);
                echo $blade->render('usuarioVerDetalles', ['usuario' => $usuario, 'sesion' => $sesion]);
            } else
                die('Error. El usuario no pudo modificarse.');
        }
    } else
        echo $blade->render('usuarioModificar', [
            'usuario' => $usuario, 'error' => $error, 'sesion' => $sesion
        ]);
}

/**
 * opCambiaNombrePass: llama a la validacion del formulario para el cambio de datos de usuario. Si no hay errores, comprueba que datos
 * quiere cambiar y hace el update. Si hay errores, muestra de nuevo el formulario. Si hace bien el update, muestra los detalles del
 * usuario actualizado. Solo para Ops.
 *
 * @return void
 */
function opCambiaNombrePass()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/baseDatosUsuariosModel.php');
    include(APP_PATH . 'models/varios.php');
    $idUsuario = $_GET["id"];
    // Si la id de usuario de la url no coincide con la id de usuario de la sesion, muestro la pantalla de login y finalizo la sesion
    if ($idUsuario != $sesion['idusuario']) {
        session_unset(); // Libera todas las variables de sesión
        session_destroy(); // Destruimos la sesión
        header('Location: ' . BASE_URL . 'index.php?controller=login&action=login');
        // Finalizamos script
        exit();
    } else {
        $user = new Usuarios();
        $usuario = $user->getUsuario($idUsuario);
        $error = validaCambioNombrePass();
        if ($_POST) {
            //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
            if ($error->HayErrores()) {
                echo $blade->render('usuarioModificarOp', [
                    'usuario' => $usuario, 'error' => $error, 'sesion' => $sesion
                ]);
            } else {
                // Compruebo ahora si solo quiere cambiar el nombre, solo la contraseña o ambos
                if (empty($_POST['nuevonombre'])) {
                    // Solo quiere cambiar la contraseña
                    $datosUsuario = "pass='" . $_POST['nuevapass'] . "'";
                }
                if (empty($_POST['nuevapass']) && empty($_POST['nuevapassrep'])) {
                    // Solo quiere cambiar el nombre
                    $datosUsuario = "nombre='" . $_POST['nuevonombre'] . "'";
                }
                if (!empty($_POST['nuevonombre']) && !empty($_POST['nuevapass']) && !empty($_POST['nuevapassrep'])) {
                    // Quiere cambiar nombre y contraseña
                    $datosUsuario = "nombre='" . $_POST['nuevonombre'] . "', pass='" . $_POST['nuevapass'] . "'";
                }
                // Si se edita correctamente el usuario, muestro la vista de los detalles del usuario
                if ($user->cambiaUsuario($datosUsuario, $idUsuario)) {
                    $usuario = $user->getUsuario($idUsuario);
                    echo $blade->render('usuarioVerDetallesOp', ['usuario' => $usuario, 'sesion' => $sesion]);
                } else
                    die('Error. El usuario no pudo modificarse.');
            }
        } else
            echo $blade->render('usuarioModificarOp', [
                'usuario' => $usuario, 'error' => $error, 'sesion' => $sesion
            ]);
    }
}

/**
 * validaCrearUsuario: funcion que filtra todos los campos del formulario de añadir usuario y devuelve el objeto GestorErrores con 
 * los mensajes de error de cada campo si existen
 *
 * @return object
 */
function validaCrearUsuario()
{
    include_once(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . "models/filtroVacio.php");
    include(APP_PATH . "models/filtroRadio.php");
    $error = new GestorErrores('<span style="color:red">', '</span>');
    if ($_POST) {
        // Compruebo que el nombre está rellenado
        if (estaVacio($_POST['nombre'])) {
            $error->AnotaError('nombre', 'El nombre no puede estar vacío.');
        }
        // Compruebo que las contraseñas no están vacías
        if (estaVacio($_POST['pass'])) {
            $error->AnotaError('pass', 'La contraseña no puede estar vacía.');
        }
        if (estaVacio($_POST['passrep'])) {
            $error->AnotaError('passrep', 'La repetición de contraseña no puede estar vacía.');
        }
        // Compruebo que las contraseñas coinciden
        if ($_POST['pass'] !== $_POST['passrep']) {
            $error->AnotaError('pass', 'Las contraseñas no coinciden.');
        }
        // Compruebo si el nombre es una cadena alfanumerica
        if (!estaVacio($_POST['nombre']) && !ctype_alnum($_POST['nombre'])) {
            $error->AnotaError('nombre', 'El nombre sólo puede estar compuesto de letras y números.');
        }
        // Compruebo si ha marcado alguna opcion del tipo de usuario
        if (!estaMarcado('tipo')) {
            $error->AnotaError('tipo', 'Debe seleccionar un tipo de usuario.');
        }
    }
    return $error;
}

/**
 * crearUsuario: funcion que valida el formulario de creación de nuevo usuario
 * Si pasa la validación, inserta el usuario en la base de datos y muestra el usuario en detalle
 * Si no la pasa, vuelve a mostrar el formulario con los errores
 *
 * @return void
 */
function crearUsuario()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/baseDatosUsuariosModel.php');
    include(APP_PATH . 'models/varios.php');
    $error = validaCrearUsuario();
    if ($_POST) {
        //Si hay algún error, muestro de nuevo el formulario con un mensaje de error en cada campo que tenga error
        if ($error->HayErrores()) {
            echo $blade->render('usuarioAñadir', [
                'error' => $error, 'sesion' => $sesion
            ]);
        } else {
            $datosUsuario = $_POST;
            $user = new Usuarios();
            // Si se crea correctamente el usuario, muestro la vista de los detalles del usuario
            $idUsuario = $user->insertaUsuario($datosUsuario);
            if ($idUsuario) {
                $usuario = $user->getUsuario($idUsuario);
                echo $blade->render('usuarioVerDetalles', ['usuario' => $usuario, 'sesion' => $sesion]);
            } else
                die('Error. El usuario no pudo crearse.');
        }
    } else
        echo $blade->render('usuarioAñadir', [
            'error' => $error, 'sesion' => $sesion
        ]);
}

/**
 * confirmarEliminarUsuario: muestra el usuario cuyo id se obtiene de la url para ver todos sus detalles y confirmar o no su borrado
 *
 * @return void
 */
function confirmarEliminarUsuario()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $idUsuario = $_GET["id"];
    $user = new Usuarios();
    $usuario = $user->getUsuario($idUsuario);
    echo $blade->render('usuarioEliminar', ['usuario' => $usuario, 'sesion' => $sesion]);
}

/**
 * eliminarUsuario: elimina el usuario cuyo id se obtiene de la url y muestra mensaje confirmando el borrado
 *
 * @return void
 */
function eliminarUsuario()
{
    // Guardo los datos de la sesion para pasarlos con blade a la vista
    session_start();
    $sesion = $_SESSION;
    include(APP_PATH . 'models/varios.php');
    require(APP_PATH . "models/baseDatosUsuariosModel.php");
    $idUsuario = $_GET["id"];
    $user = new Usuarios();
    $eliminado = $user->eliminaUsuario($idUsuario);
    if ($eliminado) {
        echo $blade->render('usuarioEliminado', ['idUsuario' => $idUsuario, 'sesion' => $sesion]);
    } else
        die('Error. El usuario no pudo eliminarse.');
}
