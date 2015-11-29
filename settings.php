<?php
include('header.php');
include('lib/config.php');
?>

<!DOCTYPE html>
<html>
<body>
    <form action="settings.php" method="POST">
    <table>
    <tr>
            
    <p>new username:
    <input type="text" name="new_username" size="20">
    <br>
    <p>new password:
    <input type="password" name="new_password" size="20">
    <input type="submit" name="submit" value="submit">
    <br>


    </p>
    </tr>
</table>
</form>
</body>
</html>

<?php
    $dbh = useDatabase();

    if (isset($_POST["new_username"]))
        {
            
            $sql = $dbh->prepare('UPDATE user SET name=? WHERE id=?');
            $sql->execute(array($_POST["new_username"], $_SESSION["user"]));
        }
    if (isset($_POST["new_password"]))
        {
            $sql = $dbh->prepare('UPDATE user SET password=? WHERE id=?');
            $sql->execute(array($_POST["new_password"], $_SESSION["user"]));
        }
?>
