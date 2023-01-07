<?php

/**
 * Session: Clase que nos permitirá gestionar de forma sencilla las sesiones
 * Técnicamente no es un modelo como los que veremos más adelante en Laravel, aunque
 * lo ponemos aquí ya que tiene lógica de la aplicación
 */
class Session
{
    const SESS_DATA = 'sess_data';
    const IDX_ESTA_DENTRO = 'idx_dentro';
    const URL_LOGIN = 'index.php?controller=login&action=login';
    const TIPO = 'tipo';
    const HORA = 'hora';
    const NOMBRE = 'nombre';
    const ID_USUARIO = 'idusuario';


    // Más ctes o atributos como tipo de usuario, nombre, etc

    static private $_instance = null;

    /**
     * Crea el objeto y abre sesión
     */
    private function __construct()
    {
        // Iniciamos session de PHP
        session_start();
    }

    /**
     * Patron Singleton. 
     * Solo necesitamos un objeto de este tipo
     */
    public static function getInstance(): Session
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * login: comprueba si el usuario que se quiere loguear existe en la base de datos y guarda los valores de la sesión en la
     * variable $_SESSION
     *
     * @param string $user Usuario a logearse
     * @param string $passwd Clave del usuario
     * @return boolean True si se ha logeado, false en caso contrario. Registra para futuras consutlas si esta dentro
     */
    public function login(string $user, string $passwd): bool
    {
        include_once(APP_PATH . 'models/baseDatosUsuariosModel.php');
        $userModel = new Usuarios();
        $usuario = $userModel->compruebaLogin($user, $passwd);
        // Si existe un usuario con esas credenciales en la base de datos, guardo en la variable $_SESSION los datos necesarios
        if ($usuario) {
            // Usuario y clave correctos
            $_SESSION[self::IDX_ESTA_DENTRO] = true;
            $_SESSION[self::HORA] = date('H:i:s');
            $_SESSION[self::TIPO] = $usuario['tipo'];
            $_SESSION[self::NOMBRE] = $usuario['nombre'];
            $_SESSION[self::ID_USUARIO] = $usuario['idusuario'];
            return true;
        }
        return false;
    }

    /**
     * Registra que ha cerrado la sessión y que el usuario ya no está logeado
     *
     * @return void
     */
    public function logout(): void
    {
        // Registra que ha salido
        $_SESSION[self::IDX_ESTA_DENTRO] = false;
        session_unset(); // Libera todas las variables de sesión
        session_destroy(); // Destruimos la sesión
    }

    /**
     * Indica si un usuario está registrado
     *
     * @return boolean
     */
    public function isLogged(): bool
    {
        return !empty($_SESSION[self::IDX_ESTA_DENTRO]);
    }

    /**
     * Comprueba si el usuario está logeado y si no está redirige a la página de login y finaliza
     * el script
     *
     * @return void
     */
    public function onlyLogged(): void
    {
        if (!$this->isLogged())
            self::redirect(self::URL_LOGIN);
    }

    /**
     * Esta functión, no debería ser de esta clase. Se pone aquí por simplificar 
     * 
     * Redirige la petición a la url indicada dentro de la aplicación
     *
     * @param string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header('Location: ' . BASE_URL . $url);
        // Finalizamos script
        exit();
    }

    /**
     * esAdmin: comprueba si un usuario registrado es de tipo administrador. Si lo es, devuelve true y  si no, devuelve false
     *
     * @return boolean
     */
    public function esAdmin()
    {
        return $_SESSION[self::TIPO] == 'administrador' ? true : false;
    }

    /**
     * esOperario: comprueba si un usuario registrado es de tipo operario. Si lo es, devuelve true y  si no, devuelve false
     *
     * @return void
     */
    public function esOperario()
    {
        return $_SESSION[self::TIPO] == 'operario' ? true : false;
    }
}
