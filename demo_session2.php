<?php
include('header.php');
?>

<!DOCTYPE html>
<html>
<body>

<?php
print_r($_SESSION);

session_unset();
session_destroy();
?>

</body>
</html>