
<?php
class Opdb{
    private $error;
	private $stmt;
	private $env;
    private $conn;
    
    public function __construct($env = 'developer'){
        $this->conn = NULL;
        $this->stmt = NULL;
        $this->env = $env;
	}

	public function __destruct() {
        if($this->conn != null){
            $this->desconectar();
        }
		return null;
    }
    
	/*Evitamos el clonaje del objeto. Patrón Singleton*/
	private function __clone(){ }
    
    private function get_jsonconfig($env){
        $json = __DIR__.'/../../inc/conf.json';
        //$json = 'C:\xampp\htdocs\moob\IPS\inc\conf.json';

        if(file_exists($json)){
            $datos_conf = file_get_contents($json);
            $conf = json_decode($datos_conf, true);
            
            if(isset($conf[$env]) && is_array($conf[$env]) && !empty($conf[$env])){
                return $conf[$env];
            }else{
                return null;
            }
            
        }else{
            die("No existe el fichero de configuracion conf");
        }
    }

    private function conectar()
    {

        if ($this->conn == null) {

            $config_env = $this->get_jsonconfig($this->env);

            if($config_env){
                $dsn = 'mysql:host='.$config_env['hostdb'].';dbname='.$config_env['namedb'].';charset='.$config_env['charsetdb'];
                $options = array(
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
                );

                try{
                    $this->conn = new PDO($dsn,$config_env['userdb'],$config_env['passdb'],$options);
                    $this->conn->exec('set names '.$config_env['charsetdb']);
                    $this->error = null;
                }catch(PDOException $e){
                    $this->conn = null;
                    $this->error = $e->getMessage();
                }

            }else{
                die('no logra el archivo de configuración');
            }
        }
    }
    
	public function desconectar()
    {
        if ($this->conn != null) {
            
            if($this->stmt != null){
                $this->stmt->closeCursor();
                $this->stmt = null;
                $this->error = null;
            }
            
            $this->conn = null;
        }
    }

    public function check_database()
    {
        $this->conectar();
        if($this->conn != null){
            $this->desconectar();
            return array('status'=>'ok');
        }else{
            return array('status'=>'nok', 'error'=>'Error de conexión a la Base de datos', 'conn_state'=>$this->error);
        }
    }


    public function add_item($table, $data_array, $close = false){
        if(!empty(trim($table)) && is_string($table)){
            if(!empty($data_array) && is_array($data_array)){

                $sql = "INSERT INTO ".$table." (`".implode("`, `", array_keys($data_array))."`) VALUES ('".implode("', '", array_values($data_array))."')";
                $this->stmt = $this->exec_sql($sql);
                if($this->stmt){
                    $lastInsertId = $this->conn->lastInsertId();
                    $this->stmt = null;
                    $this->error = null;
                    if($close){ $this->desconectar(); }
                    return $lastInsertId;
                }else{
                    return false;
                }

            }else{
                $this->error = 'Los campos para adionar no pueden estar vacíos y deben ser un array tipo llave => valor';
                return false;
            }
        }else{
            $this->error = 'El nombre de la tabla tiene que ser un texto y no puede estar vacío.';
            return false;
        }
    }

    
    public function del_item($table, $conditions, $close = false){
        if(!empty(trim($table)) && is_string($table)){

            $whereSql = $this->conditionOrder($conditions);

            $sql = "DELETE FROM ".$table.$whereSql['where'];

            if($this->exec_sql($sql)){
                $this->stmt = null;
                if($close){ $this->desconectar(); }
                return true;
            }else{
                return false;
            }

        }else{
            $this->error = 'El nombre de la tabla tiene que ser un texto y no puede estar vacío.';
            return false;
        }
    }

    public function upd_item($table, $data_array, $conditions, $close = false){
        $colvalSet = '';
        if(!empty(trim($table)) && is_string($table)){
            if(!empty($data_array) && is_array($data_array)){
                $i = 0;
                foreach($data_array as $key=>$val){
                    $pre = ($i > 0)?', ':'';
                    $colvalSet .= $pre.$key."='".$val."'";
                    $i++;
                }

                $whereSql = $this->conditionOrder($conditions);

                $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql['where'];

                if($this->exec_sql($sql)){
                    $this->stmt = null;
                    if($close){ $this->desconectar(); }
                    return true;
                }else{
                    return false;
                }

            }else{
                $this->error = 'Los campos para adionar no pueden estar vacíos y deben ser un array tipo llave => valor';
                return false;
            }
        }else{
            $this->error = 'El nombre de la tabla tiene que ser un texto y no puede estar vacío.';
            return false;
        }
    }

    public function execute_sql($sql_srting, $close = false){

        if($this->exec_sql($sql_srting)){

            if($this->stmt->rowCount() > 0 ){

                try{
                    $response = ($this->stmt->rowCount() == 1)?$this->stmt->fetch(PDO::FETCH_ASSOC):$this->stmt->fetchAll(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                    $response = true;
                }
                
                $this->stmt = null;
                if($close){ $this->desconectar(); }

                
                return $response;

            }else{
                return true;
            }
            
        }else{
            return false;
        }

    }

    public function get_error(){
        $this->stmt = null;
        return $this->error;
    }
    
    private function exec_sql($sql_srting){
        if(!empty(trim($sql_srting)) && is_string($sql_srting)){
            $this->conectar();
            if($this->conn != null){

                try{

                    $this->stmt = $this->conn->prepare($sql_srting);
                    $this->stmt->execute();
                    $this->error = null;
                    return true;

                }catch(PDOException $e){
                    $this->error = $e->getMessage();
                    return false;
                }
                
            }else{
                $this->error = 'No existe una conexión Habilitada con la base de datos';
                return false;
            }
            
		}else{
            $this->error = 'La consulta SQL no puede estar vacia y solo puede ser de tipo texto';
			return false;
		}
    }

    
    



}
?>