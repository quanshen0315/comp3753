<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
$con = mysql_connect("localhost","root","");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("comp3753", $con);

$result = mysql_query("SELECT * FROM user");

while ($row = mysql_fetch_array($result)) 
{
	echo "id: " . $row['id'] . " Name: " . $row['name'] . " password: " . $row['password'] . " email: " . $row['email'];
	echo "<br />";
}

mysql_close($con);
?>


</body>
</html>