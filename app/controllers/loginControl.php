<?php

/**
 * login: inicio de la aplicacion. Muestra el login y lo valida. Si hay errores vuelve a mostrar el login con ellos; si no, comprueba
 * si el usuario es admin u operario y muestra la vista correspondiente.
 *
 * @return void
 */
function login()
{
    include(APP_PATH . "models/GestorErrores.php");
    include(APP_PATH . 'models/varios.php');
    include(APP_PATH . 'models/filtroVacio.php');
    include_once(APP_PATH . 'models/sesionModel.php');
    $error = new GestorErrores('<div class="alert alert-danger" id="divlog" role="alert">', '</div>');
    if ($_POST) {
        // Valido que los dos campos están rellenos
        if (estaVacio($_POST['usuario']) || estaVacio($_POST['pass'])) {
            $error->AnotaError('login', 'Debe rellenar los dos campos.');
        }
        // Compruebo si el login es correcto
        else if (!Session::getInstance()->login($_POST['usuario'], $_POST['pass'])) {
            $error->AnotaError('login', 'Usuario y/o contraseña incorrectos.');
        }
        if ($error->HayErrores()) {
            echo $blade->render('login', ['error' => $error]);
        } else {
            if (Session::getInstance()->esAdmin()) {
                // Muestro la vista de administrador
                header('Location: index.php?controller=tareas&action=listar');
                //Session::redirect('index.php?controller=tareas&action=listar');
            } else {
                // Muestro la vista del operario
                header('Location: index.php?controller=tareas&action=opListar');
                //Session::redirect('index.php?controller=tareas&action=opListar');
            }
        }
    } else {
        echo $blade->render('login', ['error' => $error]);
    }
}

/**
 * salir: cierra la sesion liberando las variables y destruyendola y redirige a la pantalla de login
 *
 * @return void
 */
function salir()
{
    // Recupero los datos de la sesion que harán falta
    session_start();
    // Registra que ha salido
    $_SESSION['idx_dentro'] = false;
    session_unset(); // Libera todas las variables de sesión
    session_destroy(); // Destruimos la sesión
    header('Location: ' . BASE_URL . 'index.php?controller=login&action=login');
    // Finalizamos script
    exit();
}
