<html>
<head>
	<title></title>
</head>
<body>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
}

a:link, a:visited {
    display: block;
    width: 120px;
    font-weight: bold;
    color: #FFFFFF;
    background-color: #98347a;
    text-align: center;
    padding: 4px;
    text-decoration: none;
    text-transform: uppercase;
}

a:hover, a:active {
    background-color: #63224f;
}
</style>
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
    //$sql=$dbh->prepare('select * from photo where unum in (select fnum from follow where unum=1000)');
    //$sql->execute();

    $sql = $dbh->prepare('SELECT * FROM photo WHERE unum IN (SELECT fnum FROM follow WHERE unum=?)');
    $sql->execute(array(1000));
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