<?php
session_start();
include('header.php');
include('lib/config.php');

?>

<!DOCTYPE html>
<html>
<body>
    <form action="upload.php" method="POST">
    <table>
        <tr>
            
    <p>path:
    <input type="text" name="img_path" size="20" required/>
title:
    <input type="text" name="img_title" size="15" required/>
description:
    <input type="text" name="img_desc" size="15" required/>
    <input type="submit" name="upload" value="upload">


    </p>
    </tr>
</table>
</form>
</body>
</html>

<?php
    $dbh=useDatabase();

if (isset($_POST["img_title"]))
        {
            $sql = $dbh->prepare('SELECT MAX(id) FROM photo');
            $sql->execute();
            $new_id = ($sql->fetch()[0]) + 1;

            $date = new DateTime();
            $dt = $date->format('Y-m-d H:i:s');
            $sql = $dbh->prepare("insert into photo values (?, ?, ?, ?, ?, ?, ?)"); 
            $sql->execute(array($new_id, $date->format('Y-m-d H:i:s'),
            $_POST["img_title"], $_POST["img_desc"], 0, 0, $_SESSION["user"]));
        }
?>