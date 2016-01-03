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
        $this->increase_limit = 500;
    } 
   
    function __destruct() { 

    } 
     
    public function create_header_mysql($dataBd) { 
        
        $row = mysql_fetch_assoc($dataBd);

            fputcsv($this->fp, array_keys($row));
        
            mysql_data_seek($dataBd, 0);
    } 
     
    public function create_body_mysql($dataBd, $db, $csv) { 
        while($row = mysql_fetch_assoc($dataBd)) {

            fputcsv($this->fp, $row);

            $this->increase++;
            
            if( $this->increase == LIMIT) {
                break;
            }

            if ($this->increase == $this->icremental_limit){

                $db->add_limit($this->increase);
                $this->icremental_limit = $this->increase + 500;

                $add_query = $db->query_mysql(QUERY);
                $csv->create_body_mysql($add_query, $db, $csv);
            }
        }
        
        fclose($this->fp);
    }
    
    public function create_header_postgres($dataBd) { 
        
        $row = pg_fetch_assoc($dataBd);

            fputcsv($fp, array_keys($row));
                  
            pg_result_seek($dataBd, 0);
    } 
     
    public function create_body_postgres($dataBd, $db, $csv) { 
        while($row = pg_fetch_assoc($dataBd)) {

            fputcsv($this->fp, $row);

            $this->increase++;
            
            if( $this->increase == LIMIT) {
                break;
            }

            if ($this->increase == $this->icremental_limit){

                $db->add_limit($this->increase);
                $this->icremental_limit = $this->increase + 500;

                $add_query = $db->query_postgres(QUERY);
                $csv->create_body_postgres($add_query, $db, $csv);
            }
        }
        
        fclose($this->fp);
    } 
} 

?>