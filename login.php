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