<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'dbconnect.php';

//var_dump($_GET);
$conn2 = setconnection('localhost', 'root', '', 'ui-data');

$offset = isset($_GET['offset'])?$_GET['offset']:0;
$limit = isset($_GET['limit'])?$_GET['limit']:100;
$callback = isset($_GET['callback'])?$_GET['callback']:'C';
$queryId = isset($_GET['queryid'])?$_GET['queryid']:1 ;
$sortCol = isset($_GET['sortcol'])?$_GET['sortcol']:null;
$sortOrder = isset($_GET['sortorder'])?$_GET['sortorder']:"asc";
$filters = isset($_GET['filters'])?$_GET['filters']:0;
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
$generatedQuery = generateQuery($storedQuery['query'], $metaArray2);
$query = $generatedQuery['finalQuery'];
$columns = $generatedQuery['columns'];
//var_dump($columns);
//echo $query;


$result = mysql_query($query, $conn);
//echo mysql_error();



/*$i=0;
while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result, $i);
    if (!$meta) {
        echo "No information available<br />\n";
        }
    $columns[$i] = $meta->name;
    $i++;
}*/

$processedFilters = array();
//echo $filters;
if($filters > 0){
    for($i=0;$i < $filters;$i++){
        $filterCount = "filter" . ($i + 1);
        //echo $filterCount;
        $filterValue = $_GET[$filterCount];
        $processedFilters[$i] = $columns[$i] . " LIKE '" . $filterValue . "%'";
    }
}
//var_dump($processedFilters);

if (strpos($query, 'WHERE') !== FALSE){
    //echo 'Found it';
    if(count($processedFilters)>0)
        $query = $query . ' AND ' . implode(' AND ', $processedFilters);
}
else{
    if(count($processedFilters)>0)
        $query = $query . ' WHERE ' . implode(' AND ', $processedFilters);
}
    
$result = mysql_query($query, $conn);
//echo implode(' AND ', $processedFilters);
//echo '<br/>';
if($sortCol != null){
    $sortCol += 1;
    $query = $query . " ORDER BY " . $sortCol . " " . $sortOrder;
}

$query = $query . " LIMIT " . $offset . ", " . $limit;
$numRows = mysql_num_rows($result);
//echo '<br/>' . $query . '<br/>';

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
