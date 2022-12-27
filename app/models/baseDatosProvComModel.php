<?php
include_once("baseDatosModel.php");

class ProvCom
{
    public function __construct()
    {
    }

    /**
     * getProvincias: devuelve un array donde se almacena cada provincia con su respectivo código numérico
     *
     * @return Array
     */
    public function getProvincias()
    {
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT * FROM tbl_provincias");
        $provincias = array();
        while ($provincia = $stm->fetch()) {
            $provincias[] = $provincia;
        }
        return $provincias;
    }
}
