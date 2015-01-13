<?php
/*
Connect to the local server using Windows Authentication and specify
the AdventureWorks database as the database in use. To connect using
SQL Server Authentication, set values for the "UID" and "PWD"
 attributes in the $connectionInfo parameter. For example:
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=>"AdventureWorks");

*/

$db_server   = '172.16.107.88';
$db_database = 'dbSudamSicas';
$db_user     = 'sa';
$db_passwd   = 'cgti*2013';

$aInfo = array("UID" => $db_user, 
               "PWD" => $db_passwd,
               "Database" => $db_database);

$conn = sqlsrv_connect($db_server, $aInfo);

if($conn){
    echo "Connection established.\n";
    
    $sql  = "select
                T1.COLUMN_NAME as Field,
                T1.DATA_TYPE as 'Type', 
                T1.IS_NULLABLE as 'Null',
                case
                            when SUBSTRING(T2.CONSTRAINT_NAME,0, 3) = 'PK' then 'PRI'
                            when SUBSTRING(T2.CONSTRAINT_NAME,0, 3) = 'FK' then 'MUL'
                            else '' 
                    End as 'Key',
                T1.COLUMN_DEFAULT as 'Default', 
                case
                            when SUBSTRING(T2.CONSTRAINT_NAME,0, 3) = 'PK' then 'auto_increment'
                            else '' 
                    End as Extra
            from 
                INFORMATION_SCHEMA.COLUMNS T1
            left join information_schema.KEY_COLUMN_USAGE T2
                    on (T1.TABLE_NAME = T2.TABLE_NAME
                            and T1.COLUMN_NAME = T2.COLUMN_NAME
                            and SUBSTRING(T2.CONSTRAINT_NAME,0, 3) <> 'IX')
            where 
                    T1.TABLE_NAME='sicas_procedimento'";
    
    $consulta = sqlsrv_query($conn, $sql);
    
    if($consulta === false){
        echo "Error in executing query.</br>";
        print "<pre>"; print_r( sqlsrv_errors()); print "</pre>";exit;
    }

/* Retrieve and display the results of the query. */
    print "<pre>";
    while ($row = sqlsrv_fetch_array($consulta)){
        print_r($row);
    }
    print "</pre>";
}
else{
    echo "Connection could not be established.\n";
    print "<pre>"; print_r( sqlsrv_errors()); print "</pre>";exit;
}

//-----------------------------------------------
// Perform operations with connection.
//-----------------------------------------------

/* Close the connection. */
sqlsrv_close( $conn);
