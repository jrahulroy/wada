<?php
session_start();

include('dbconnect.php');
$queryId = isset($_GET['queryid'])?$_GET['queryid']:1;

$uiConn = defaultConnection();
$query = getQueryString($queryId, $uiConn);
echo mysql_error();
//echo $_SESSION["servername"];
$dataConn = setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],$_SESSION["database"]);

$filename = "query_" . $queryId;    

$metaArray2 = generateMeta($dataConn, $query['database']);
//var_dump($metaArray2);
$sql = generateQuery($query['query'], $metaArray2);
//var_dump($sql);
//$Connect = mysql_connect($DB_Server, $DB_Username, $DB_Password);
//$Db = mysql_select_db($DB_DBName, $Connect);
$result = mysql_query($sql['finalQuery'],$dataConn);
echo mysql_error();

$file_ending = "xls";
$sep = "\t"; 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");
//end of printing column names
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
?>

