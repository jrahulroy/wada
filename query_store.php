<?php
session_start();
include("dbconnect.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$conn=setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],"ui-data");

$query_string = $_POST['query_string'];
//echo $query_string;

//echo "<br />";
$query = "INSERT INTO QUERIES(query_string) VALUES ('" . mysql_real_escape_string($query_string) . "')";
//echo $query;
//echo "<br />";
mysql_query($query, $conn);

//echo mysql_error();

$qid = mysql_insert_id();

echo $qid;
?>
