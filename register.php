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
	header("Locaion:register.html");
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