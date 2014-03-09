<?php
function setconnection($servername,$username,$password,$database)
{
$conn=mysql_connect($servername,$username,$password);
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
echo "connected...";
echo $conn;
}
}
return $conn;
}


?>