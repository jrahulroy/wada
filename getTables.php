<?php
$dbname = 'classicmodels';

if (!mysql_connect('localhost', 'root', '')) {
    echo 'Could not connect to mysql';
    exit;
}

$sql = "SHOW TABLES FROM " . $dbname;
$result = mysql_query($sql);



if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

$count2 = 0;
while ($row = mysql_fetch_row($result)) {
	//echo $row[0] . '<br />';
	$options["options"][$count2]['value'] = $row[0];
	$options["options"][$count2]['text'] = $row[0];
	$count2++;
	}

	echo json_encode($options);
?>






