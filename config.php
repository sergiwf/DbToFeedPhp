<?php 

$properties = parse_ini_file("properties.ini"); 

if (empty($properties['limit'])) {
	
	$properties['limit'] = 'default';
}

define("DB_HOST", $properties['databaseServer']); 
define("DB_USER", $properties['user']); 
define("DB_PASSWORD", $properties['password']); 
define("DB_DATABASENAME", $properties['databaseName']); 
define("DB_DATABASE", strtolower($properties['database'])); 
define("DB_PORT", $properties['databasePort']); 
define("QUERY", $properties['select']); 
define("OUTPUT", $properties['output']); 
define("LIMIT", strtolower($properties['limit'])); 

?>
