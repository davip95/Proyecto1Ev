<?php
include_once("baseDatosModel.php");

class Usuarios
{
    public function __construct()
    {
    }

    /**
     * compruebaLogin: valida si las credenciales de usuario y contraseña se corresponden con un usuario guardado en la base de datos
     * Si existe, devuelve un array con los datos de ese usuario, si no, devuelve false
     *
     * @param  string $nombre
     * @param  string $pass
     * @return mixed
     */
    public function compruebaLogin($nombre, $pass)
    {
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT * FROM usuarios WHERE nombre='" . $nombre . "' AND pass='" . $pass . "'");
        return $stm->fetch();
    }

    /**
     * getProvincias: devuelve un array con el id y el nombre de la tabla 'operarios'
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
