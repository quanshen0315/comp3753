<?php
session_start();
include('header.php');

?>

<!DOCTYPE html>
<html>
<body>

<?php
if(isset($_SESSION["user"]))
    {
        session_unset();
        session_destroy();
        print("You logged out!");
    }

?>

</body>
</html>