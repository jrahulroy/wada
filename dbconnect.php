<?php
function setconnection($servername,$username,$password,$database)
{
        $conn=mysql_connect($servername,$username,$password);
        if(!$conn)
        die("couldnt connect to database....");
        else
        {
        if(!mysql_select_db($database,$conn))
        {
        die("couldnt connect defined database....");
        }
        else
        {
        //echo "connected...";

        }
    }
return $conn;
}

function generateMeta($conn, $databaseName){
    $query = "SELECT 
            CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME 
            FROM 
            INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE 
            TABLE_SCHEMA = '" . $databaseName . "'";
    //Meta Array[0-PRI OR EXT, 1- tableName,2 - columnName, 3 - refTableName,4-refColumnName];
    //$metaArray = array();
    $metaSet = mysql_query($query, $conn);
    
    $count=0;
    //$metaArray2 = array();
    for($i=0;$i<mysql_num_rows($metaSet);$i++){
        $meta = mysql_fetch_array($metaSet);
        //var_dump($meta);
        
        
        
        if($meta[0] == 'PRIMARY'){
            $metaArray[$count] = array();
            
            $metaArray[$count][0] = 'PRI';
            
            $metaArray[$count][1] = $meta[1];
            $metaArray[$count][2] = $meta[2];
            
            $metaArray2['' . $meta[1] . '.' . $meta[2] . ''] = 'PRI';
            
            $count++;
        } 
        else if(substr($meta[0],0,2) ==  'fk'){
            $metaArray[$count] = array();
            
            $metaArray[$count][0] = 'FOR';
            
            $metaArray[$count][1] = $meta[1];
            $metaArray[$count][2] = $meta[2];
        
            $metaArray[$count][3] = $meta[3];
            $metaArray[$count][4] = $meta[4];
            
            //array_push ( array &$array , mixed $var [, mixed $... ] )
            $metaArray2['' . $meta[1] . '.' . $meta[2] . ''] = $meta[3] . '.' . $meta[4];
            
            
            $count++;   
        }
        
    }
    /*
    echo '<pre>';
    echo '<br/>';
    var_dump($metaArray);
    echo '<br/>';
    var_dump($metaArray2);
    echo '<br/>';
    echo '</pre>';
    */
    return $metaArray2;
    
}
?>