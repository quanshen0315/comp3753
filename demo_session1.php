<?php
session_start();
include('header.php');
?>

<!DOCTYPE html>
<html>
<body>

<?php
$_SESSION["user"] = 1005;
echo "Session variables are set.";
?>

</body>
</html>