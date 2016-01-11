<?php 
class DB_CONNECT { 
    private $conexion;
    private $limit;

    function __construct() { 

        $this->limit = " LIMIT " . LIMIT;
    } 
   
    function __destruct() { 

    } 

    public function add_limit($addlimit) { 
            
        $this->limit = " LIMIT " . LIMIT . " OFFSET $addlimit"; 
    } 
   
    public function connect_mysql() { 
            
        $this->conexion = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_PORT) or die('No se pudo conectar: ' . mysql_error()); 
    } 

    public function query_mysql($query) { 
            
        mysql_select_db(DB_DATABASENAME, $this->conexion);

        $data_query = mysql_query($query . $this->limit); 

        return $data_query; 
    } 
    
    public function close_mysql() { 

        mysql_close($this->conexion); 
    } 
    
    public function connect_postgres() { 
        
        $conn_string = "host=" . DB_HOST . " port=" . DB_PORT ." dbname=" . DB_DATABASENAME . " user=" . DB_USER . " password=" . DB_PASSWORD;

        $this->conexion = pg_connect($conn_string) or die("No se pudo conectar");
    } 

    public function query_postgres($query) { 
            
        $data_query = pg_query($query . $this->limit) or die('La consulta fallo: ' . pg_last_error());
       
        return $data_query; 
    } 
    
    public function close_postgres() { 

        pg_close($this->conexion); 
    } 
} 

?>
