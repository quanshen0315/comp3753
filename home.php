<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>


<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="register.php">Register</a></li>
  <li><a href="settings.php">Settings</a></li>
</ul>



  <?php

try {

    $dbh = new PDO('mysql:host=localhost;dbname=comp3753',
    'root', '');

    $current_user = 1000;

    $sql = $dbh->prepare('SELECT * FROM photo WHERE unum IN (SELECT fnum FROM follow WHERE unum=?)');
    $sql->execute(array($current_user));
    $rc = $sql->rowCount();

    while($row = $sql->fetch())
        {
            print($row['unum'] . "<br>");
            $img = $row['id'] . ".jpg";
            echo "<img src='img/$img' alt='hello' height='256' width='256'><br>";
        }

    $dbh = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

     ?>


</body>
</html>