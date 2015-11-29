<?php
include('lib/config.php');
include('header.php');

if(!isset($_SESSION["user"]) && !isset($_GET["user"]))
    header('Location: /login.php');

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

if ($user != $_SESSION["user"])
    {
        $sql = $dbh->prepare('SELECT fnum FROM follow WHERE unum=? AND fnum=?');
        $sql->execute(array($_SESSION["user"], $_GET["user"]));
        if(!$sql->fetch())
            {
                print("<form action='profile.php' method='POST'>");
                print("<input type='submit' name='follow' value='follow'>");
            }
        else
    }
echo "<br>";

$sql = $dbh->prepare('SELECT * FROM photo WHERE unum=?');
$sql->execute(array($user));

while($row = $sql->fetch())
    {
        draw_photo($row, 300, 256);
    }


if (isset($_POST["follow"]))
    {
        $sql = $dbh->prepare('INSERT INTO follow VALUES (?, ?)');
        $sql->execute($user, $_GET["user"]);
    }
?>