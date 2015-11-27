<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>

<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="register.php">Register</a></li>
  <li><a href="settings.php">Settings</a></li>
</ul>

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
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['password'] . "</td><td>" . $row['email']. "</td></tr>";
    }

mysql_close($con);
?>



</tr>
</table>

</body>
</html>