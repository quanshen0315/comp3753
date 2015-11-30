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
<form action="moderator.php" method="POST">
<input type="text" name="Un"required/>
<input type="text" name="reason"/>
<input type="radio" name="mode" value= "gphoto"checked>photo is ok  
<input type="radio" name="mode" value="dphoto">delete photo  
<input type="radio" name="mode" value="duser">delete user  
<input type="radio" name="mode" value="amoder">add user to be moderator  
<input type="submit" name="submit"><br>
</form>
<p style="letter-spacing:1px">first:user_id or photo_id</p>
<p style="letter-spacing:1px">second:reason</p>

<table>
<tr>
    <th width="400">reason</th>
    <th width="80" align="middle">report</th>
    <th width="80" align="middle">photo id</th>
    <th width="80" align="middle">photo belong</th>
    <th>photo</th>
</tr>   
<tr>
<?php
    $dbh = useDatabase();

    $sql = $dbh->prepare('SELECT * FROM report');
    $find = $dbh->prepare('SELECT * FROM photo where id=?');
    $sql->execute();
    foreach ($sql->fetchAll() as $row) {
        $img_id = $row["pnum"];
        $find->execute(array($img_id));
        foreach($find->fetchAll() as $cp)

        print("<tr><td>" . $row['reason'] . '</td><td align="middle">' . $row['unum'] . '</td><td align="middle">' . $img_id .  '</td><td align="middle">' . $cp['unum'] ."</td><td>" . "<img src='img/$img_id.jpg' align='middle' height=150>" . "</td></tr>");
    }
    if(isset($_POST['submit']))
    {
        $in = $_POST['Un'];
        $option = $_POST['mode'];
        $re = $_POST['reason'];
        switch ($option) 
        {
            case 'gphoto':
                if(!is_numeric($in))
                    exit('please enter photo id');
                $search = $dbh->prepare('SELECT * FROM photo WHERE id=?');
                $search->execute(array($in));
                if(empty($search->fetchAll()))
                    exit('not find this photo');
                $delr = $dbh->prepare('DELETE FROM report WHERE pnum=?');
                $delr->execute(array($in));
                break;
            case 'dphoto':
                if(!is_numeric($in))
                    exit('please enter photo id');
                $search = $dbh->prepare('SELECT * FROM photo WHERE id=?');
                $search->execute(array($in));
                if(empty($search->fetchAll()))
                    exit('not find this photo');
                $delr = $dbh->prepare('DELETE FROM report WHERE pnum=?');
                $delp = $dbh->prepare('UPDATE photo SET del=1 WHERE id=?');
                $delr->execute(array($in));
                $delp->execute(array($in));
                break;
            case 'duser':
                if (empty($_POST['reason']))
                    exit("please input reason if you want to disable user!");
                if(!is_numeric($in))
                {
                    $search = $dbh->prepare('SELECT * FROM user WHERE name=?');
                    $search->execute(array($in));
                    if(empty($result = $search->fetchAll()))
                        exit('not find this user');
                    $check = $dbh->prepare('SELECT * FROM disable WHERE unum=?');
                    foreach($result as $row){
                        $check->execute(array($row['id']));
                        if(!empty($check->fetchAll()))
                            exit('already disabled');
                    }

                }
                else
                {
                    $search = $dbh->prepare('SELECT * FROM user WHERE id=?');
                    $search->execute(array($in));
                    if(empty($search->fetchAll()))
                        exit('not find this user');
                    $check = $dbh->prepare('SELECT * FROM disable WHERE unum=?');
                    $check->execute(array($in));
                    if(!empty($check->fetchAll()))
                        exit('already disabled');
                }

                $reg = "INSERT INTO disable" . "(dtime, reason, unum, mnum) VALUES " . "(?, ?, ?, ?)";
                $delu = $dbh->prepare($reg);
                $date = new Datetime();
                $dt = $date->format('Y-m-d');
                $delu->execute(array($dt, $re, $in, $_SESSION['user']));
                break;
            case 'amoder':
                if(!is_numeric($in))
                {
                    $search = $dbh->prepare('SELECT * FROM user WHERE name=?');
                    $search->execute(array($in));
                    if(empty($result = $search->fetchAll()))
                        exit('not find this user');
                    $check = $dbh->prepare('SELECT * FROM moderator WHERE unum=?');
                    foreach($result as $row){
                        $check->execute(array($row['id']));
                        if(!empty($check->fetchAll()))
                            exit('already exist');
                    }
                }
                else
                {
                    $search = $dbh->prepare('SELECT * FROM user WHERE id=?');
                    $search->execute(array($in));
                    if(empty($search->fetchAll()))
                        exit('not find this user');
                    $check = $dbh->prepare('SELECT * FROM moderator WHERE unum=?');
                    $check->execute(array($in));
                    if(!empty($check->fetchAll()))
                        exit('already exist');
                }
                $reg = "INSERT INTO moderator" . "(ctime, unum, mnum) VALUES " . "(?, ?, ?)";
                $delu = $dbh->prepare($reg);
                $date = new Datetime();
                $dt = $date->format('Y-m-d');
                $delu->execute(array($dt, $in, $_SESSION['user']));
                break;
        }
    }
    
?>
</body>
</html>