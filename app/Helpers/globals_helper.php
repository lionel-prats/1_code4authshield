<?php  
/**
 * helper incluido en globals_helper.php
 *
 * imprime por pantalla el parametro recibido
 *
 * @param string $data el dato que queremos imprimir
 *
 * @param int $exit un numero entero (default null) 
 * @return none imprime el dato recibido por parametro, con opcion a a cortar la ejecucion
*/
function ddl($data, $exit = null) {
	if($exit == "v") {
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		return;
	} elseif($exit == "ve") {
		echo "<pre>";
		var_dump($data);
		exit;
	} elseif($exit == "pe") {
		echo "<pre>";
		print_r($data);
		exit;
	}
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function get_sql_query($orm_query) {
	// forma de uso en, por ejemplo, un controlador vvv
	// get_sql_query($pelicula_model->getLastQuery());
	echo "<pre>";    
	echo $orm_query;
	echo "</pre>";  
}