<?php
include("lib/config.php");
include('header.php');  

try {
	$dbh = new PDO('mysql:host=localhost;dbname=comp3753;charset=utf8', 
    "root", $config["pass"]);

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
