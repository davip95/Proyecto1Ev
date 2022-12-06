<?php
include_once("baseDatos.php");

class Usuarios
{
    public function __construct()
    {
    }

    /**
     * getProvincias: devuelve un array con todos los registros de la tabla 'operarios'
     *
     * @return array
     */
    public function getOperarios()
    {
        /*$query = Database::getInstance()->dbh->prepare("SELECT * FROM operarios");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $resultado = $query->fetchAll();
        return $resultado;*/
        return Database::getInstance()->getAll('operarios');
    }

    public function getTareaPendiente()
    {
    }

    public function addTarea()
    {
    }

    public function updateTareas()
    {
    }

    public function delTareas()
    {
    }
}
