<?php

/** 
* @author sergiwf <sergiwf@gmail.com>
* @copyright 2016 sergiwf
*/ 
 
require_once 'config.php';
require_once 'connect.php';
require_once 'createCsv.php';

$db = new DB_CONNECT();
$csv = new CREATE_CSV();  

if ( DB_DATABASE == 'postgres' ) {
    
    $db->connect_postgres();

    $data_query = $db->query_postgres(QUERY);

    $csv->create_header_postgres($data_query);
    
    $csv->create_body_postgres($data_query, $db);
    
    $db->close_postgres();
 
} else if( DB_DATABASE == 'mysql' )  {
    
    $db->connect_mysql();

    $data_query = $db->query_mysql(QUERY);

    $csv->create_header_mysql($data_query);
    
    $csv->create_body_mysql($data_query, $db);

    $db->close_mysql();    
}
	
?>