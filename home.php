<?php    
include 'lib/config.php';
include 'header.php';

if(!isset($_SESSION["user"]))
    header('Location: /login.php');


try {

    $dbh = useDatabase();

    $sql = $dbh->prepare('SELECT * FROM photo inner join user on 
                          photo.unum=user.id WHERE unum IN 
                          (SELECT fnum FROM follow WHERE unum=?)');

    $sql->execute(array($_SESSION["user"]));

    while($row = $sql->fetch())
        {
            draw_photo($row, 300, 256);
        }

    $dbh = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
