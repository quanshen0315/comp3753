<?php
	include('header.php');
include('lib/config.php');
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>
	<form action="register.php" method="POST">
		<table>
			<tr>
				<td>username:</td>
				<td><input type="text" name="Un" required/></td>
			</tr>
			<tr>
				<td>password:</td>
				<td><input type="password" name="psw" required/></td>
			</tr>
			<tr>
				<td>re-password:</td>
				<td><input type="password" name="psw2" required/></td>
			</tr>
			<tr>
				<td>e-mail:</td>
				<td><input type="email" name="email" required/></td>
			</tr>
			<tr>
				<td><input type="submit" name="register_sub" value="register"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
if(isset($_POST['Un']) && isset($_POST['psw'])&& isset($_POST['psw2'])&& isset($_POST['email']))
{
	try {
        $dbh = useDatabase();
} catch (PDOException $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
	die();
}

$name = $_POST['Un'];
$pass = $_POST['psw'];
$rpass = $_POST['psw2'];
$email = $_POST['email'];

if($pass != $rpass)
{   
	exit("password not same"); //password not same
}


$check1 = $dbh->prepare('SELECT * FROM user where name=?');      //check the same username
$check1->execute(array($name));
if(!empty($check1->fetchAll()))
{
	exit("name exist");
}

$check2 = $dbh->prepare('SELECT * FROM user where email=?');     //check the same email
$check2->execute(array($email));
if(!empty($check2->fetchAll()))
{
	exit("email exist");
}

$id = $dbh->prepare('SELECT MAX(id) FROM user');  //get the Max id
$id->execute();
(int)$uid = ($id->fetch()['0']) + 1;
echo $uid;

$reg = "INSERT INTO user" 
		. "(id, name, password, email) VALUES " 
		. "(?, ?, ?, ?)";

$create = $dbh->prepare($reg);
$create->execute(array($uid, $name, $pass, $email));
header("Location:login.php");
}
?>