<?php

/**
 * Database: clase de abstracción de base de datos
 */
class Database
{
    public $dbh = null;   // Database Handle, es el nombre de variable que se suele utilizar para el objeto PDO
    private static $dns = "mysql:host=localhost;dbname=bunglebuild";
    private static $user = "root";
    private static $pass = "";

    //Propiedad estática, inicializada a nulo, donde guardaremos la instancia de la propia clase
    private static $instance;

    /**
     * __contruct: Definimoms el método constructor como privado.
     * Conecta a la base de datos del Data Source Name ($dns) con un PDO
     *
     */
    private function __contruct()
    {
        $this->dbh = new PDO(self::$dns, self::$user, self::$pass);
    }

    /**
     * getInstance: Método estatico que sirve como punto de acceso global
     * Si no hay instancia creada, lo hace. Si la hay, la devuelve.
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;


        /*if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;*/
    }

    /**
     * dbh: devuelve el database handle de la clase Database
     *
     * @return mixed
     */
    public function dbh()
    {
        return $this->dbh;
    }

    /**
     * Genera al vuelo la consulta insert into para los campos que le indicamos
     * en la tabla indicada
     *
     * @param string $tabla
     * @param array $campos
     * @return bool
     */
    public function insert(string $tabla, $campos): bool
    {
        $nombre_campos = implode(',', array_keys($campos)); // => c1, c2,...
        $valores_campos = array_values($campos); // => v1, v2, ..
        $interrogaciones = implode(',', array_map(fn ($v) => '?', $campos));

        $sql = "INSERT INTO $tabla ($nombre_campos) VALUES ($interrogaciones)";

        /*
		// Para depuración
		echo "<pre>SQL: $sql \n Interrogaciones: [$interrogaciones]\nValores \n";
		print_r($valores_campos);
		exit;
		*/

        return $this->dbh
            ->prepare($sql)
            ->execute($valores_campos);
    }


    /**
     * Devuelve el registro de la tabla indicada cuyo valor es igual que el indicado en $search_value 
     * en el campo de la tabla $key_field
     *
     * @param string $tabla Nombre de la tabla
     * @param string $search_value Valor a buscar
     * @param string $key_field	Nombre campo de la tabla
     * @return array|null
     */
    public function find(string $tabla, string $search_value, string $key_field = 'id'): ?array
    {
        $sql = "select * from $tabla where $key_field=:key_value limit 1";
        $campos = ['key_value' => $search_value];


        /*
		// Para depuración
		echo "<pre>SQL: $sql \n Valores\n";
		print_r($campos);
		//exit;*/
        $pdo_stm = $this->dbh->prepare($sql);
        $pdo_stm->execute($campos);
        return $pdo_stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * getAll: Devuelve todos los registros de una tabla que se pasa como parámetro
     *
     * @param  string $tabla
     * @return array
     */
    public function getAll(string $tabla)
    {
        /*$stm = $this->dbh->prepare("SELECT * FROM $tabla");
        $stm->execute();
        return $stm->fetchAll();*/
        $stm = $this->dbh->query("SELECT * FROM $tabla");
        return $stm->fetchAll();
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
