<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php
    include('header.php');
    include('lib/config.php');
    if(!isset($_SESSION["moderator"]))
    {
    	header('Location:login.php');
    	exit();
    }
    if($_SESSION["moderator"] == False)
    {
    	header('Location:home.php');
    	exit("you are not moderator");
    }
?>
<table>
<tr>
    <th width="400">reason</th>
    <th width="80" align="middle">report</th>
    <th width="80" align="middle">photo id</th>
    <th>photo</th>
</tr>   
<tr>
<?php
    $dbh = useDatabase();

    $sql = $dbh->prepare('SELECT * FROM report');
    $sql->execute();
    foreach ($sql->fetchAll() as $row) {
        $img_id = $row["pnum"];
        print("<tr><td>" . $row['reason'] . '</td><td align="middle">' . $row['unum'] . '</td><td align="middle">' . $img_id .  "</td><td>" . "<img src='img/$img_id.jpg' align='middle' height=150>" . "</td></tr>");
    }
    
?>
</body>
</html>