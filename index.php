<?php 

ob_start();

session_start();

include "dbconnect.php" ;

if(isset($_POST["servername"])&&isset($_POST["uname"])&&isset($_POST["dbname"]))
{
echo $servername=$_POST["servername"]; $uname=$_POST["uname"]; $pwd=$_POST["pwd"]; $dbname=$_POST["dbname"];
if(!empty($_POST["servername"])&&!empty($_POST["uname"])&&!empty($_POST["dbname"]))
																							{
$connection=setconnection($servername,$uname,$pwd,$dbname);
$_SESSION["servername"]=$servername;
$_SESSION["uname"]=$uname;
$_SESSION["pwd"]=$pwd;
$_SESSION["database"]=$dbname;
if($connection)
{
header("Location: dashboard.php");
}
																							}}
?>
<html>
<head>
<link rel="stylesheet" href="connectpage.css" />
</head>

<body>
<img src="images\logo.png" alt="logo" id="image"/>
<img src="images\logo1.png" alt="logo" id="image1"/>
<div  id="dbdiv">

<label style="color:#903; position:absolute; margin-left:50;"><h3>Login To Your Database</h3></label>
<br />
<br />
<br />
<form name="database" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Servername:&nbsp;<input type="text"  name="servername"size="20"  style=" height:30;" /><br/><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="uname" size="20"  style=" height:30;" /><br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pwd" size="20"  style=" height:30;" /><br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DbName:&nbsp;&nbsp;&nbsp&nbsp;&nbsp;<input type="text" name="dbname" size="20"  style=" height:30;" /> <br /><br />
<input type="submit" value="connect" style=" margin-left:180; width:80; margin-top:-5; height:35;"/>
</form>
</div>
</body>
</html>
