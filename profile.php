<?php
session_start();
include('lib/config.php');
include('header.php');

if (isset($_GET["user"]))
    {
        $user = $_GET["user"];
    }
else
    $user = $_SESSION["user"];

$dbh = useDatabase();

$sql = $dbh->prepare('SELECT * FROM user WHERE id=?');

$sql->execute(array($user));

while($row = $sql->fetch())
    {
        print("ID: " . $row["id"] . "<br>");
        print("Name: " . $row["name"] . "<br>");
        print("Email: " . $row["email"] . "<br>");
    }

echo "<br>";

$sql = $dbh->prepare('SELECT * FROM photo WHERE unum=?');
$sql->execute(array($user));

while($row = $sql->fetch())
    {
        draw_photo($row, 300, 256);
    }
?>