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
?>
<table>
<tr>
	<th>id</th>
	<th>name</th>
	<th>pass</th>
	<th>email</th>
</tr>	
<tr>
<?php
$result = mysql_query("SELECT * FROM user");

while ($row = mysql_fetch_array($result)) 
{
	echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['password'] . "</td><td>" . $row['email']. "</td></tr>";
}

mysql_close($con);
?>
</tr>
</table>

</body>
</html>