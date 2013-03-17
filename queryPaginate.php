<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'dbconnect.php';

$conn2 = setconnection('localhost', 'root', '', 'ui-data');

$offset = isset($_GET['offset'])?$_GET['offset']:0;
$limit = isset($_GET['limit'])?$_GET['limit']:100;
$callback = isset($_GET['callback'])?$_GET['callback']:'C';
$queryId = isset($_GET['queryid'])?$_GET['queryid']:1;
 //$db=mysql_connect($host, $username, $password) or die('Could not connect');
   // mysql_select_db($db_name, $db) or die('');
//echo $queryId;
$query = generateQuery(getQueryString($queryId, $conn2));

$conn = setconnection('localhost', 'root', '', 'sakila');
if(!$conn){
    die('Connection  Creation Failed');
}

$result = mysql_query($query, $conn);
$numRows = mysql_num_rows($result);

$query = $query . " LIMIT " . $offset . ", " . $limit;
//echo $query;

    $result = mysql_query($query, $conn); //or die('Could not query');
    echo mysql_error();
    $json = array();
    $json['data'] = array();
    if(mysql_num_rows($result)){
            $row=mysql_fetch_assoc($result);
        while($row=mysql_fetch_row($result)){
            //  cast results to specific data types

            $test_data[]=$row;
        }
        $json['data']=$test_data;
    }
    $json['total']=$numRows;
    $json['count'] = mysql_num_rows($result);
    mysql_close($conn);
echo $callback . '(';

    echo json_encode($json);
echo ');';
?>
