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

    /**
     * getUsuario: devuelve un array con todos los datos del usuario cuyo id se pasa como parametro
     *
     * @param  int $idUsuario
     * @return array
     */
    public function getUsuario($idUsuario)
    {
        $data = Database::getInstance();
        $stm = $data->dbh->query("SELECT * FROM usuarios WHERE idusuario=" . $idUsuario . "");
        $usuario = $stm->fetch();
        return $usuario;
    }

    /**
     * getUsuariosPags: devuelve un array en el que se guarda un array con la informacion de cada usuario que aparece en la pagina que se esta viendo,
     * el numero de usuarios por pagina y la pagina actual
     *
     * @param  mixed $condicion: campo de la tabla por el que filtrar
     * @param  mixed $valorCond: valor del campo de la tabla por el que se quiere filtrar
     * @return Array
     */
    public function getUsuariosPags($condicion = '', $valorCond = '')
    {
        $data = Database::getInstance();
        $usuariosPorPagina = 4;
        // Por defecto es la página 1 pero si está presente en la URL, se toma esa
        $pagina = 1;
        if (isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }
        // El límite es el número de usuarios por página
        $limit = $usuariosPorPagina;
        # El offset es saltar X usuarios que viene dado por multiplicar la página - 1 * los usuarios por página
        $offset = ($pagina - 1) * $usuariosPorPagina;
        // Compruebo si hay alguna condicion y valor de esta para ejecutar la sentencia con la clausula WHERE
        if ($condicion != '' && $valorCond != '')
            $stm = $data->dbh->query("SELECT * FROM usuarios WHERE $condicion = $valorCond LIMIT $limit OFFSET $offset");
        else {
            $stm = $data->dbh->query("SELECT * FROM usuarios LIMIT $limit OFFSET $offset");
        }
        $usuarios = array();
        while ($usuario = $stm->fetch()) {
            $usuarios[] = $usuario;
        }
        return [$usuarios, $usuariosPorPagina, $pagina];
    }

    /**
     * conteoUsuarios: obtiene el numero de usuarios y los divide entre los usuarios por pagina para obtener las paginas totales para la paginacion. 
     * Devuelve el numero de paginas y el numero de usuarios
     *
     * @param  mixed $condicion: campo de la tabla por el que filtrar
     * @param  mixed $valorCond: valor del campo de la tabla por el que se quiere filtrar
     * @return Array
     */
    public function conteoUsuarios($condicion = '', $valorCond = '')
    {
        $usuariosPorPagina = 4;
        $data = Database::getInstance();
        // Compruebo si hay alguna condicion y valor de esta para ejecutar la sentencia con la clausula WHERE
        if ($condicion != '' && $valorCond != '')
            $stm = $data->dbh->query("SELECT count(*) AS conteo FROM usuarios WHERE $condicion = $valorCond");
        else {
            $stm = $data->dbh->query("SELECT count(*) AS conteo FROM usuarios");
        }
        $conteo = $stm->fetchObject()->conteo;
        // Para obtener las páginas dividimos el conteo entre los usuarios por página, y redondeamos hacia arriba
        $paginas = ceil($conteo / $usuariosPorPagina);
        return [$paginas, $conteo];
    }

    /**
     * cambiaUsuario: actualiza el nombre y/o la contraseña del usuario cuyo id se pasa como parámetro.
     *
     * @param  string $datosUsuario
     * @param  int $idUsuario
     * @return boolean
     */
    public function cambiaUsuario($datosUsuario, $idUsuario)
    {
        $data = Database::getInstance();
        $stm = $data->dbh->query("UPDATE usuarios SET $datosUsuario WHERE idusuario =" . $idUsuario . "");
        if ($stm) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * insertaUsuario: inserta en la base de datos el usuario cuyos datos se pasan como parametro. Si el insert se ejecuta correctamente devuelve el ultimo ID insertado, sino devuelve false
     *
     * @param  mixed $datosUsuario
     * @return boolean
     */
    public function insertaUsuario($datosUsuario)
    {
        $data = Database::getInstance();
        $datos = "'" . $datosUsuario['nombre'] . "','" . $datosUsuario['pass'] . "','" . $datosUsuario['tipo'] . "'";
        $stm = $data->dbh->query('INSERT INTO usuarios VALUES(NULL,' . $datos . ')');
        if ($stm) {
            return $data->dbh->lastInsertId();
        } else {
            return false;
        }
    }

    /**
     * eliminaUsuario: elimina el usuario cuyo ID se pasa como parámetro de la base de datos
     *
     * @param  int $idUsuario
     * @return boolean
     */
    public function eliminaUsuario($idUsuario)
    {
        $data = Database::getInstance();
        $stm = $data->dbh->prepare("DELETE FROM usuarios WHERE idusuario= ?;");
        $res = $stm->execute([$idUsuario]);
        return $res;
    }
}
