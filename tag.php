<?php
include('header.php');
include('lib/config.php');

$dbh = useDatabase();
$sql = $dbh->prepare("select * from tags inner join photo on tags.pnum=photo.id where tag=?");

$sql->execute(array($_GET["tag"]));

print("<h1>". $_GET["tag"] . "</h1>");

while ($row = $sql->fetch())
    {
        draw_photo($row, 300, 256);
    }

?>