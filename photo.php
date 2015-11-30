<?php
include('header.php');
include('lib/config.php');

if (isset($_GET["img"]))
    {
        $dbh = useDatabase();
        $img = $_GET["img"];

        $sql = $dbh->prepare('SELECT * FROM photo WHERE id=?');
        $sql->execute(array($img));
        $row = $sql->fetch();

        // Views
        $new_viewcount = $row["views"];
        $new_viewcount++;
        $sql = $dbh->prepare('UPDATE photo SET views=? WHERE id=?');
        $sql->execute(array($new_viewcount, $img));

        // Image
        print("<h1>" . $row["title"] . "</h1>");
        print("<img src='img/$img.jpg' align='middle'><br><br>");

        print("<p>" . $row["desciption"] . "</p>");
        print("<p>" . $row["views"] . " views</p>");

        // Likes
        $sql = $dbh->prepare('SELECT ld FROM decide WHERE pnum=?');
        $sql->execute(array($img));

        $likes = 0;

        while ($row = $sql->fetch())
            {
                if ($row["ld"] == 1)
                    $likes++;
            }

        print("<p>" . $likes . " likes</p>");

        print("<form action='photo.php?img=$img' method='POST'>");
        print("<input type='submit' name='like' value='like'></form>");


        // Tags
        $sql = $dbh->prepare('SELECT tag FROM tags WHERE pnum=?');
        $sql->execute(array($img));

        while ($row = $sql->fetch())
            {
                $tag = $row["tag"];
                print("<a href='tag.php?tag=$tag'>$tag</a>");
            }

        // Comments
        print("<form action='photo.php?img=$img' method='POST'>");
        print("<textarea rows='4' cols='50' name='comment'></textarea><br>");
        print("<input type='submit' value='post'></form>");
        

        $sql = $dbh->prepare('select * from comments inner join user 
                             on user.id=comments.unum where pnum=?');
        $sql->execute(array($img));

        while ($crow = $sql->fetch())
            {
                print("<h2>" . $crow["name"] . "</h2>");
                print("<p>" . $crow["comment"] . "</p>");
            }
    }
else
    print("file not found");

?>

<html>
<body>



</body>
</html>

<?php
if (isset($_POST["like"]))
    {
        $sql = $dbh->prepare("SELECT * FROM decide WHERE unum=? and pnum=?");
        $sql->execute(array($_SESSION["user"], $img));
        $row = $sql->fetch();

        if ($row["ld"] != 1)
            {
   
                $date = new DateTime();
                $dt = $date->format('Y-m-d');
                $sql = $dbh->prepare("INSERT INTO decide VALUES (?, ?, ?, ?)");
                $sql->execute(array($dt, 1, $_SESSION["user"], $img));
                header("photo.php?img=$img");
            }
    }

if (isset($_POST["comment"]))
    {
        $sql = $dbh->prepare("SELECT MAX(id) FROM comments");
        $sql->execute();
        $new_id = $sql->fetch();
        $new_id[0]++;

        $date = new DateTime();
        $dt = $date->format('Y-m-d H:i:s');

        $sql = $dbh->prepare("INSERT INTO comments VALUES (?, ?, ?, ?, ?)");
        $sql->execute(array($new_id[0], $dt, $_POST["comment"],
        $_SESSION["user"], $img));

        // secrets
        $sql = $dbh->prepare("SELECT name FROM user WHERE id=?");
        $sql->execute(array($_SESSION["user"]));
        $username = $sql->fetch()["name"];

        print("<h2>" . $username . "</h2>");
        print("<p>" . $_POST["comment"] . "</p>");

        
    }
?>