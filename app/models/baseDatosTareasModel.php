<?php
include_once("baseDatosModel.php");

class Tareas
{
    public function __construct()
    {
    }

    /**
     * getTareas: devuelve un array donde se almacena todas las tareas guardadas en la base de datos
     *
     * @return Array
     */
    public function getTareas()
    {
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT * FROM tareas ORDER BY fechafin DESC");
        $tareas = array();
        while ($tarea = $stm->fetch()) {
            $tareas[] = $tarea;
        }
        return $tareas;
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
