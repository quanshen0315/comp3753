 <?php
session_start();     
include 'lib/config.php';
include 'header.php';


try {

    $dbh = new PDO('mysql:dbname=' . $config["dbname"] . 
    ';host=' . $config["host"], $config["user"], $config["pass"]);

    $sql = $dbh->prepare('SELECT * FROM photo inner join user on 
                          photo.unum=user.id WHERE unum IN 
                          (SELECT fnum FROM follow WHERE unum=?)');

    $sql->execute(array($_SESSION["user"]));

    while($row = $sql->fetch())
        {
            print($row['name'] . "<br>");
            $img = $row[0] . ".jpg";
            echo('<a href="photo.php?img=' . $row[0] . '">');
            echo("<img src='img/$img' alt='hello' height='256' 
                 width='256'><br>");
            echo('</a>');
        }

    $dbh = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

     ?>


</body>
</html>