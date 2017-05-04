<?php
//require_once 'classes/class.Conexao.PDO.php';

try{
    $db_server 	 = '172.16.107.90';//srv-homologa
    $db_database = 'DBBADAM';
    $db_user 	 = 'sa';
    $db_passwd 	 = 'cgti*2013';

    $db = new PDO("sqlsrv:server=$db_server;database=$db_database;", $db_user, $db_passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e){
    echo "<pre>Conexao Falhou: " . $e->getMessage()."</pre>";
}
$stm = $db->query("select * from INFORMATION_SCHEMA.TABLES");
//$stm = $db->query("select * from information_schema.KEY_COLUMN_USAGE");

while ($aReg = $stm->fetch(PDO::FETCH_ASSOC)){
    $aObj[] = $aReg;
}
print "<pre>"; print_r($aObj); print "</pre>"; 


//$oConexao = new Conexao("sqlserver", "srv-homologa", "dbHSudamSicas", "sa","cgti*2013");
//$oConexao->execute("select * from husersicas.sicas_lotacao");

//while ($aReg = $oConexao->fetchReg()){
//    $aObj[] = $aReg;
//}
//print "<pre>"; print_r($aObj); print "</pre>"; 

/*
print "<pre>"; print_r($db);print "</pre>"; 
//$stm = $db->query("select * from usersicas.sicas_lotacao");
$stm = $db->query("select * from INFORMATION_SCHEMA.TABLES");

//$stm = $db->query("select * from sys.databases");

//print_r($stm->fetch(PDO::FETCH_ASSOC));

 while ($aReg = $stm->fetch(PDO::FETCH_ASSOC)){
    $aObj[] = $aReg['TABLE_NAME'];
}
print "<pre>"; print_r($aObj); print "</pre>========================="; 

$db = new PDO("sqlsrv:server=$db_server;database=master;", $db_user, $db_passwd);
$stm = $db->query("select * from INFORMATION_SCHEMA.TABLES");

//$stm = $db->query("select * from sys.databases");

//print_r($stm->fetch(PDO::FETCH_ASSOC));
$aObj = array();
while ($aReg = $stm->fetch(PDO::FETCH_ASSOC)){
    $aObj[] = $aReg['TABLE_NAME'];
}
print "<pre>"; print_r($aObj); print "</pre>"; 
 *
 */
