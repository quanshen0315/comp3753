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


</body>
</html>
=======
<?php
try {
	$dbh = new PDO('mysql:host=localhost;dbname=comp3753;charset=utf8', "root", "");
} catch (PDOException $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
	die();
}

$stmt = $dbh->prepare('SELECT * FROM user WHERE name=?');
$stmt->execute(array($_POST["l_un"]));
$result = $stmt->fetchAll();

foreach ($result as $row) {
    if ($row['password'] == $l_psw)
  	    header("Location:home.php");
    else
  	    header("Location:login.html");	# code...
}
?>
>>>>>>> a31d6d54bf1634fa81b6093b1b1aa6c8fac3cc06
