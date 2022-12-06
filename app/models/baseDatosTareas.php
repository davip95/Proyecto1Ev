<?php
require("baseDatos.php");

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
        return Database::getInstance()->getAll('tareas');
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
