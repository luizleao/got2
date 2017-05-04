<?php
$host     = 'localhost';
$dbname   = 'visitantes';
$user     = 'postgres';
$password = 'postgres';

$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password") or die("Deu merda!");

if($conn){   
/*
	$meta = pg_meta_data($conn, 'Registro', true);
	if (is_array($meta)) {
	  echo '<pre>';print_r($meta);echo '</pre>';
	}
*/	
    
	//$sql  = "SELECT * FROM information_schema.columns WHERE table_name ='Registro';";
	$sql = "SELECT
/*				n.nspname AS esquema_de,
				nf.nspname AS esquema_para,
				ct.conname AS chave,
				pg_get_constraintdef(ct.oid) AS criar_sql,			
				cl.relname AS tabela_de,
				a.attname AS coluna_de,
*/
				clf.relname AS tabela_para,
				af.attname AS coluna_para
				
			FROM 
				pg_catalog.pg_attribute a
			JOIN pg_catalog.pg_class cl 
				ON (a.attrelid = cl.oid 
					AND cl.relkind = 'r')
			JOIN pg_catalog.pg_namespace n 
				ON (n.oid = cl.relnamespace)
			JOIN pg_catalog.pg_constraint ct 
				ON (a.attrelid = ct.conrelid 
					AND ct.confrelid != 0 
					AND ct.conkey[1] = a.attnum)
			JOIN pg_catalog.pg_class clf 
				ON (ct.confrelid = clf.oid 
					AND clf.relkind = 'r')
			JOIN pg_catalog.pg_namespace nf 
				ON (nf.oid = clf.relnamespace)
			JOIN pg_catalog.pg_attribute af 
				ON (af.attrelid = ct.confrelid 
					AND af.attnum = ct.confkey[1])
			where
				cl.relname = 'Registro'
				and a.attname = 'idMotivo'";
	
    $consulta = pg_query($conn, $sql);
    
    if($consulta === false){
        echo "Error in executing query.</br>";
        print "<pre>".pg_last_error()."</pre>";exit;
    }

    print "<pre>";
    while ($row = pg_fetch_assoc($consulta)){
        print_r($row);
    }
    print "</pre>";

}
else{
    echo "Conexão não estabelecida";
    print "<pre>".pg_last_error()."</pre>";exit;
}

//-----------------------------------------------
// Perform operations with connection.
//-----------------------------------------------

/* Close the connection. */
pg_close( $conn);
