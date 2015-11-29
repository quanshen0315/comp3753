<?php
session_start();
include('header.php');
<<<<<<< HEAD
if(!isset($_SESSION["user"]))
    header('Location:login.php');
=======
>>>>>>> 868ca68d845d6d629c46d18df1704ec18ccc3ce7

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