<?php 
class CREATE_CSV { 
    private $fp; 
    private $increase;
    private $increase_limit;

    function __construct() { 
       
        if (OUTPUT == 'default') {
                
                $this->fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/downloadBd.csv" , 'w');

        } else {

            $this->fp = fopen( OUTPUT . "/downloadBd.csv" , 'w');
        }

        $this->increase = 0;
        $this->increase_limit = LIMIT;
    } 
   
    function __destruct() { 

    } 
     
    public function create_header_mysql($dataBd) { 
        
        $row = mysql_fetch_assoc($dataBd);

            fputcsv($this->fp, array_keys($row));
        
            mysql_data_seek($dataBd, 0);
    } 
     
    public function create_body_mysql($dataBd, $db) { 
        while($row = mysql_fetch_assoc($dataBd)) {

            fputcsv($this->fp, $row);

            $this->increase++;
       
            if ($this->increase == $this->increase_limit){

                $db->add_limit($this->increase);
                $this->increase_limit = $this->increase + LIMIT;

                $add_query = $db->query_mysql(QUERY);
                $this->create_body_mysql($add_query, $db);

                return;
            }
        }
        
        $this->close_fp();
    }
    
    public function create_header_postgres($dataBd) { 
        
        $row = pg_fetch_assoc($dataBd);

            fputcsv($fp, array_keys($row));
                  
            pg_result_seek($dataBd, 0);
    } 
     
    public function create_body_postgres($dataBd, $db) { 
        while($row = pg_fetch_assoc($dataBd)) {

            fputcsv($this->fp, $row);

            $this->increase++;
            
            if ($this->increase == $this->increase_limit){

                $db->add_limit($this->increase);
                $this->increase_limit = $this->increase + LIMIT;

                $add_query = $db->query_postgres(QUERY);
                $this->create_body_postgres($add_query, $db);

                return;
            }
        }
        
        $this->close_fp();
    } 

    public function close_fp() { 
            
        fclose($this->fp);

        echo "Download complete, $this->increase file affected.";
    } 
} 

?>
