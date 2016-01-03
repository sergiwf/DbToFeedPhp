<?php 
class DB_CONNECT { 
    private $conexion;
    private $dbconn;
    private $limit;

    function __construct() { 

        if( LIMIT == 'default' || LIMIT > 500 ){
               
            $this->limit = " limit 0,500";

        } else {

            $this->limit = " limit 0," . LIMIT;
    
        }
        
    } 
   
    function __destruct() { 

    } 

    public function add_limit($addlimit) { 
            
        $this->limit = " limit " . $addlimit .",500";
    
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
        
        $conn_string = "host=DB_HOST port=DB_PORT dbname=DB_DATABASENAME user=DB_USER password=DB_PASSWORD";

        $this->conexion =  pg_connect($conn_string) or die("No se pudo conectar");
    } 

     public function query_postgres($query) { 
            
        $data_query = pg_execute($this->conexion, "my_query", $query . $this->limit);

        return $data_query; 
    } 
    
    public function close_postgres() { 

        pg_close($this->conexion); 
    } 
} 

?>