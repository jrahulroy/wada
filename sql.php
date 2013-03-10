<p> Welcome to the Application </p>
<?php $today = getdate();
print_r($today); ?>



<?php
$dbname = 'classicmodels';

if (!mysql_connect('localhost', 'root', '')) {
    echo 'Could not connect to mysql';
    exit;
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);



if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
echo '<pre>';
while ($row = mysql_fetch_row($result)) {
    echo "Table: " . $row[0] . " <br/>";
	echo "Columns <br/>";
	
	$sql2 = "SHOW COLUMNS FROM " . $row[0] . " FROM classicmodels";
	echo $sql2;
	$result2 = mysql_query($sql2);
	echo $result2;
	while ($row2 = mysql_fetch_row($result2)) {
		print_r($row2);
	}	
}
echo '</pre>';
mysql_free_result($result);
?>
