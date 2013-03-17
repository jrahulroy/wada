<?php
session_start();
include('dbconnect.php');
//echo '<p>Hello</p><br />';
$conn = setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],"ui-data");

$query_id = $_GET['query_id'];

$query = "SELECT query_string from QUERIES WHERE queryid = '" . $query_id . "'";

//echo $query;

$resultSet = mysql_query($query, $conn);
//var_dump($resultSet);
$queryResult = mysql_fetch_array($resultSet);



$query_string =  $queryResult[0];
//echo $query_string . '<br />';

$query_array = json_decode($query_string);


//var_dump($query_array);

//$tables = 
//var_dump(array_unique($query_array));
$count = 0;
$tables = array();
$columns = array();
$tables[0] = "Hi";
//var_dump($tables);
for($i=0;$i < count($query_array) ;$i++){
    if($i==0){
        $tables[$count] = $query_array[$i][0];
        $count++;
        
    }
    else if($query_array[$i][0] != $query_array[$i-1][0]){
        $tables[$count] = $query_array[$i][0];
        $count++;
    }
    $columns[$i] = $query_array[$i][1];
};


//echo implode(",", $tables);
//echo implode(",", $columns);
//var_dump($columns);

$finalQuery = 'SELECT ' . implode(",", $columns) . ' FROM ' . implode(",", $tables);

echo '<br/>' . $finalQuery;
//var_dump($tables);

$conn2=setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],$_SESSION["database"]);

//$finalRS = mysql_query($finalQuery, $conn2);


//$querytable="select * from ".$_GET['dbselect']." ";


    if($tableres=mysql_query($finalQuery, $conn2))
    {
        //var_dump(mysql_fetch_field($tableres));
        //$colres=mysql_query('SHOW COLUMNS FROM ',$conn);
        echo "<table id='restable' border=5>";
        echo "<tr>";
        $i = 0;
        while($i < count($columns)) {
            echo "<th>{$columns[$i]}</th>";
            $i++;
        }
        echo "</tr>";
        while($tablerow=mysql_fetch_array($tableres)) {
            echo "<tr>";
            for($i=0;$i<  mysql_num_fields($tableres);$i++) {
            echo "<td>{$tablerow[$i]}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    else {
    echo "<br/>Result Failed";
    echo mysql_error();
    
    }


//$columns

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
