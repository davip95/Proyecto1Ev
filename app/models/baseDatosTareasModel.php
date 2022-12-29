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

    /**
     * getTareasPags: devuelve un array en el que se guarda un array con la informacion de cada tarea que aparece en la pagina que se esta viendo,
     * el numero de tareas por pagina y la pagina actual
     *
     * @return Array
     */
    public function getTareasPags()
    {
        $data = Database::getInstance();
        $tareasPorPagina = 5;
        // Por defecto es la página 1 pero si está presente en la URL, se toma esa
        $pagina = 1;
        if (isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }
        // El límite es el número de tareas por página
        $limit = $tareasPorPagina;
        # El offset es saltar X tareas que viene dado por multiplicar la página - 1 * las tareas por página
        $offset = ($pagina - 1) * $tareasPorPagina;
        $stm = $data->dbh->query("SELECT * FROM tareas ORDER BY fechacreacion DESC LIMIT $limit OFFSET $offset");
        $tareas = array();
        while ($tarea = $stm->fetch()) {
            $tareas[] = $tarea;
        }
        return [$tareas, $tareasPorPagina, $pagina];
    }

    /**
     * conteoTareas: obtiene el numero de tareas y las divide entre las tareas por paginas para obtener las paginas totales para la paginacion. 
     * Devuelve el numero de paginas y el numero de tareas
     *
     * @return Array
     */
    public function conteoTareas()
    {
        $tareasPorPagina = 5;
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT count(*) AS conteo FROM tareas");
        $conteo = $stm->fetchObject()->conteo;
        // Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
        $paginas = ceil($conteo / $tareasPorPagina);
        return [$paginas, $conteo];
    }

    /**
     * insertaTarea: inserta en la base de datos la tarea que se pasa como parametro. Si el insert se ejecuta correctamente devuelve true, sino devuelve false
     *
     * @param  mixed $datosTarea
     * @return boolean
     */
    public function insertaTarea($datosTarea)
    {
        $data = Database::getInstance();
        $datos = "'" . $datosTarea['dni'] . "','" . $datosTarea['nombre'] . "','" . $datosTarea['apellidos'] . "','" . $datosTarea['telefono'] . "','"
            . $datosTarea['descripcion'] . "','" . $datosTarea['correo'] . "','" . $datosTarea['direccion'] . "','" . $datosTarea['poblacion'] . "','"
            . $datosTarea['codpostal'] . "','" . $datosTarea['provincia'] . "','" . $datosTarea['estado'] . "','" . $datosTarea['fechacreacion'] . "','"
            . $datosTarea['operario'] . "','" . $datosTarea['fechafin'] . "','" . $datosTarea['anotaantes'] . "','" . $datosTarea['anotapost'] . "'";
        $stm = $data->dbh->query("INSERT INTO tareas VALUES(NULL," . $datos . ")");
        if ($stm) {
            return true;
        } else {
            return false;
        }
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
