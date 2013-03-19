<?php
function setconnection($servername,$username,$password,$database, $flag = false)
{
        $conn=mysql_connect($servername,$username,$password, $flag);
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
    $metaArray2 = array();
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

function generateQuery($queryString, $metaArray2){
    
    $query_array = json_decode($queryString);


    //var_dump($query_array);

    //$tables = 
    //var_dump(array_unique($query_array));
    $count = 0;
    $tables = array();
    $columns = array();
    $wheres = array();
    
    $tables[0] = "Hi";
    //var_dump($tables);
    for($i=0;$i < count($query_array) ;$i++){
        $query_array[$i][2] = $query_array[$i][0] . '.' . $query_array[$i][1];
        if($i==0){
            $tables[$count] = $query_array[$i][0];
            $count++;

        }
        else if($query_array[$i][0] != $query_array[$i-1][0]){
            $tables[$count] = $query_array[$i][0];
            $count++;
        }
        $columns[$i] = $query_array[$i][0]. '.' .$query_array[$i][1];
    };
    //var_dump($query_array);
    for($i=0, $wheresI=0;$i < count($query_array) ;$i++){
        $key = $query_array[$i][2];
        if( isset($metaArray2[$key]) ){
            $pri = $metaArray2[$key];
            //echo $pri;
            //if(in_array($pri, $query_array))
               // echo '<br/>' . $pri . ':' . in_array($pri, $query_array) . ':';
            if($pri != 'PRI' && inarray($pri, $query_array, 2)){
                $wheres[$wheresI] = ' ' . $key . ' = ' . $pri . ' ';
                $wheresI++;
            }
        }
    }
    

    //echo implode(",", $tables);
    //echo implode(",", $columns);
    //var_dump($columns);
    //echo count($wheres);
    if(count($wheres) > 0){
        $finalQuery = 'SELECT ' . implode(",", $columns) . 
                    ' FROM ' . implode(",", $tables) . 
                    ' WHERE' . implode(" AND ", $wheres);
    }
    else{
        $finalQuery = 'SELECT ' . implode(",", $columns) . ' FROM ' . implode(",", $tables);
    }
    return $finalQuery;

}
function inarray($key, $array, $index){
        for($i=0;$i<count($array);$i++){
            if($key == $array[$i][$index])
                return true;
        }
        return false;
    }
    
function getQueryString($queryId, $conn){
    
    $getQuery = "SELECT query_string, databaseName from QUERIES WHERE queryid = '" . $queryId . "'";

    //echo $query;

    $resultSet = mysql_query($getQuery, $conn);
    //var_dump($resultSet);
    //echo mysql_error();
    $queryResult = mysql_fetch_array($resultSet);
    //echo mysql_error();
    
    $query['query'] = $queryResult[0];
    $query['database'] = $queryResult[1];

    //$queryString =  $queryResult[0];
    //var_dump($query);
    return $query;

}
?>