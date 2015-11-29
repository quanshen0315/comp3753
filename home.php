 <?php
session_start();     
include 'lib/config.php';
include 'header.php';
include 'lib/fun.php';

try {
    if (!isset($_SESSION))
        {
            header("Location:login.php");
        }

    $dbh = new PDO('mysql:dbname=' . $config["dbname"] . 
    ';host=' . $config["host"], $config["user"], $config["pass"]);

    $sql = $dbh->prepare('SELECT * FROM photo inner join user on 
                          photo.unum=user.id WHERE unum IN 
                          (SELECT fnum FROM follow WHERE unum=?)');

    $sql->execute(array($_SESSION["user"]));

    $column = 1;
    while($row = $sql->fetch())
        {
            if ($column % 3 == 0)
                {
                    echo "<br>";
                }
            draw_photo($row, 300, 256);

            $column++;
        }

    $dbh = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

     ?>


</body>
</html>