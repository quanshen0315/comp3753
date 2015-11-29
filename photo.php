// remember to disable commenting for non-users

<?php
include('header.php');
include('lib/config.php');

$dbh = useDatabase();

$sql = $dbh->prepare('SELECT * FROM photo WHERE id=?');
$sql->execute(array($_GET["img"]));

$row = $sql->fetch();

if ($row)
    {
        $new_viewcount = $row["views"];
        $new_viewcount++;
        $sql = $dbh->prepare('UPDATE photo SET views=? WHERE id=?');
        $sql->execute(array($new_viewcount, $_GET["img"]));

        $img_id = $row["id"];

        print("<h1>" . $row["title"] . "</h1>");
        print("<img src='img/$img_id.jpg' align='middle'><br><br>");

        print("<p>" . $row["desciption"] . "</p>");
        print("<p>" . $new_viewcount . " views</p>");

        // Likes

        $sql = $dbh->prepare('SELECT ld FROM decide WHERE pnum=?');
        $sql->execute(array($_GET["img"]));

        $likes = 0;

        while ($lrow = $sql->fetch())
            {

                if ($lrow["ld"] == 1)
                    $likes++;
            }

        print("<p>" . $likes . " likes</p>");

        // Tags

        $sql = $dbh->prepare('SELECT tag FROM tags WHERE pnum=?');
        $sql->execute(array($_GET["img"]));

        while ($trow = $sql->fetch())
            {
                $tag = $trow["tag"];
                print("<a href='tag.php?tag=$tag'>$tag</a>");
            }

        // Comments

        $sql = $dbh->prepare('select * from comments inner join user on user.id=comments.unum where pnum=?');
        $sql->execute(array($_GET["img"]));

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