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

$user = $_POST('r_un');
$pass = $_POST('r_pas');
$r_pass = $_POST('r_pas_r');
$email = $_POST('r_email');

if($pass != $r_pass)
{
	echo "wrong";
	header("Location:register.html");
}

$stmt = $dbh->prepare('SELECT name=? or email=? FROM user');
$id = $dbh->prepare('SELECT MAX(id) FROM user');
$stmt->execute(array($_POST["r_un"], $_POST['r_email']));
$result = $stmt->fetchAll();
if (is_null($result))


$sql = "INSERT INTO user" 
		. "(id, name, password, email) VALUES " 
		. "(:id, :name, :password, :email)";	

$stmt = $dbh->prepare('SELECT * FROM user WHERE name=?');
$stmt->execute(array($_POST["Un"]));
$result = $stmt->fetchAll();

foreach ($result as $row) {
    if ($row['password'] == $psw)
  	    header("Location:home.php");
    else
  	    header("Location:login.html");	# code...
}
?>
>>>>>>> a31d6d54bf1634fa81b6093b1b1aa6c8fac3cc06
