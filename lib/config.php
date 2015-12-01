<?php

$config=array(
    "dbname" => "comp3753",
    "user" => "root",
    "pass" => "",
    "host" => "localhost"
);

// constants for the database connection
define("DSN", "mysql:host=localhost;dbname=comp3753");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "");

// function which requires using the database
function useDatabase()
{
	// try to connect and set to report all errors
	$db = new PDO(DSN, USERNAME, PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

	return $db;
}

function draw_photo($row, $width, $height)
{

    $img = $row[0] . ".jpg";
    echo('<a href="photo.php?img=' . $row[0] . '">');
    echo("<img src='img/$img' alt='hello' height='$height' 
                 width='$width'>");
    echo('</a>');


}


?>
