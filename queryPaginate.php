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
$queryId = isset($_GET['queryid'])?$_GET['queryid']:1 ;
$sortCol = isset($_GET['sortcol'])?$_GET['sortcol']:null;
$sortOrder = isset($_GET['sortorder'])?$_GET['sortorder']:"asc";
 //$db=mysql_connect($host, $username, $password) or die('Could not connect');
   // mysql_select_db($db_name, $db) or die('');
//echo $queryId;





//$conn2 = setconnection('localhost', 'root', '', 'ui-data');
$storedQuery = getQueryString($queryId, $conn2);
$conn = setconnection('localhost', 'root', '', $storedQuery['database'], true);
if(!$conn){
    die('Connection  Creation Failed');
}
$metaArray2 = generateMeta($conn, $storedQuery['database']);
$query = generateQuery($storedQuery['query'], $metaArray2);
//echo $query;


$result = mysql_query($query, $conn);
//echo mysql_error();

$numRows = mysql_num_rows($result);

if($sortCol != null){
    $sortCol += 1;
    $query = $query . " ORDER BY " . $sortCol . " " . $sortOrder;
}

$query = $query . " LIMIT " . $offset . ", " . $limit;
//echo $query;

//Implementing Sorting Condition





    $result = mysql_query($query, $conn); //or die('Could not query');
    echo mysql_error();
    $json = array();
    $json['data'] = array();
    if(mysql_num_rows($result)){
        //$row=mysql_fetch_assoc($result);
        //$test_data = array();
        while($row=mysql_fetch_row($result)){
            //  cast results to specific data types
            //var_dump($row);
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
