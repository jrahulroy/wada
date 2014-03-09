<?php
session_start();
include("dbconnect.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$conn=  defaultConnection();

$query_string = $_POST['query_string'];
//echo $query_string;

//echo "<br />";
$query = "INSERT INTO QUERIES(databaseName, query_string ) VALUES ('" . $_SESSION["database"] . "','" . mysql_real_escape_string($query_string) . "')";
//echo $query;
//echo "<br />";
mysql_query($query, $conn);
//echo mysql_error();
//echo mysql_error();

$qid = mysql_insert_id();

echo $qid;
?>
