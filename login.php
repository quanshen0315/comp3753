<?php
    session_start();
	include('header.php');
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>

	<form action="login.php" method="POST">
	<table>
		<tr>
			username:
			<input type="text" name="Un" size="10" required/>
			password:
			<input type="password" name="psw" size="10" required/>
			<input type="submit" name="login" value="login">
			<input type="button" name="register" value="register" onclick="location.href='register.php'">
		</tr>
	</table>
	</form>
</body>
</html>
<?php
if(isset($_POST['Un']) && isset($_POST['psw']))
{
try {
	$dbh = new PDO('mysql:host=localhost;dbname=comp3753;charset=utf8', "root", "");
} catch (PDOException $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
	die();
}

$stmt = $dbh->prepare('SELECT * FROM user WHERE name=?');
$stmt->execute(array($_POST['Un']));
$result = $stmt->fetchAll();
if(empty($result))
	exit("wrong username or password!");

foreach ($result as $row) {
    if ($row['password'] == $_POST['psw'])
    {
    	$_SESSION["user"] = $row['id'];
  	    header("Location:home.php");
    }
    else
    	exit("wrong username or password!");
}
$check = $dbh->prepare('SELECT * FROM moderator WHERE unum=?');
$check->execute(array($_SESSION["user"]));
$cresult = $check->fetchAll();
if(empty($cresult))
	$_SESSION["moderator"] = False;
else
	$_SESSION["moderator"] = True;
}
?>