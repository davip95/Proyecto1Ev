<?php
include_once("baseDatosModel.php");

class Tareas
{
    public function __construct()
    {
    }


    /**
     * getTarea: devuelve un array con todos los datos de la tarea cuyo id se pasa como parametro
     *
     * @param  int $idTarea
     * @return Array
     */
    public function getTarea($idTarea)
    {
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT * FROM tareas WHERE idtarea=" . $idTarea . "");
        $tarea = $stm->fetch();
        return $tarea;
    }

    /**
     * getTareasPags: devuelve un array en el que se guarda un array con la informacion de cada tarea que aparece en la pagina que se esta viendo,
     * el numero de tareas por pagina y la pagina actual
     *
     * @param  mixed $condicion: campo de la tabla por el que filtrar
     * @param  mixed $valorCond: valor del campo de la tabla por el que se quiere filtrar
     * @return Array
     */
    public function getTareasPags($condicion = '', $valorCond = '')
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
        // Compruebo si hay alguna condicion y valor de esta para ejecutar la sentencia con la clausula WHERE
        if ($condicion != '' && $valorCond != '')
            $stm = $data->dbh->query("SELECT * FROM tareas WHERE $condicion = $valorCond ORDER BY fechacreacion DESC LIMIT $limit OFFSET $offset");
        else {
            $stm = $data->dbh->query("SELECT * FROM tareas ORDER BY fechacreacion DESC LIMIT $limit OFFSET $offset");
        }
        $tareas = array();
        while ($tarea = $stm->fetch()) {
            // Paso las fechas a formato español antes de guardarlas para mostrarlas con blade
            $tarea['fechacreacion'] = date("d/m/Y", strtotime($tarea['fechacreacion']));
            if ($tarea['fechafin'] != "") {
                $tarea['fechafin'] = date("d/m/Y", strtotime($tarea['fechafin']));
            }
            $tareas[] = $tarea;
        }
        return [$tareas, $tareasPorPagina, $pagina];
    }

    /**
     * conteoTareas: obtiene el numero de tareas y las divide entre las tareas por paginas para obtener las paginas totales para la paginacion. 
     * Devuelve el numero de paginas y el numero de tareas
     *
     * @param  mixed $condicion: campo de la tabla por el que filtrar
     * @param  mixed $valorCond: valor del campo de la tabla por el que se quiere filtrar
     * @return Array
     */
    public function conteoTareas($condicion = '', $valorCond = '')
    {
        $tareasPorPagina = 5;
        $data = Database::getInstance();
        // Compruebo si hay alguna condicion y valor de esta para ejecutar la sentencia con la clausula WHERE
        if ($condicion != '' && $valorCond != '')
            $stm = $data->dbh->query("SELECT count(*) AS conteo FROM tareas WHERE $condicion = $valorCond");
        else {
            $stm = $data->dbh->query("SELECT count(*) AS conteo FROM tareas");
        }
        $conteo = $stm->fetchObject()->conteo;
        // Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
        $paginas = ceil($conteo / $tareasPorPagina);
        return [$paginas, $conteo];
    }

    /**
     * insertaTarea: inserta en la base de datos la tarea que se pasa como parametro. Si el insert se ejecuta correctamente devuelve el ultimo ID insertado, sino devuelve false
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
            return $data->dbh->lastInsertId();
        } else {
            return false;
        }
    }

    /**
     * editaTarea: modifica en la base de datos la tarea que se pasa como parametro. Si el update se ejecuta correctamente devuelve true, sino devuelve false
     *
     * @param  mixed $datosTarea
     * @return boolean
     */
    public function editaTarea($datosTarea)
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
}
