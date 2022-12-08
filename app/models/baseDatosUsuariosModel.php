<?php
include("baseDatosModel.php");

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
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT * FROM operarios");
        $operarios = array();
        while ($operario = $stm->fetch()) {
            $operarios[] = $operario;
        }
        return $operarios;
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
