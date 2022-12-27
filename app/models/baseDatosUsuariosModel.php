<?php
include_once("baseDatosModel.php");

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
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT idusuario, nombre FROM usuarios WHERE tipo='operario'");
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
