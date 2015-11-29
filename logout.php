<?php
include('header.php');
if(!isset($_SESSION["user"]))
    header('Location:login.php');

?>

<!DOCTYPE html>
<html>
<body>

<?php
session_unset();
session_destroy();

print("You logged out!");
?>

</body>
</html>