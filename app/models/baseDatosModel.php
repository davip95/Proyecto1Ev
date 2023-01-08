<?php

/**
 * Database: clase de abstracción de base de datos
 */
class Database
{
    public $dbh;   // Database Handle, es el nombre de variable que se suele utilizar para el objeto PDO

    //Propiedad estática, inicializada a nulo, donde guardaremos la instancia de la propia clase
    private static $instance;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=bunglebuild', 'root', '');
    }

    /**
     * getInstance: Método estatico que sirve como punto de acceso global
     * Si no hay instancia creada, lo hace. Si la hay, la devuelve.
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $conex = __CLASS__;
            self::$instance = new $conex;
        }
        return self::$instance;
    }
}
