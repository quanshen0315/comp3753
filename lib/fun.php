<?php
// probably bad

function draw_photo($row, $width, $height)
{

    $img = $row[0] . ".jpg";
    echo('<a href="photo.php?img=' . $row[0] . '">');
    echo("<img src='img/$img' alt='hello' height='$height' 
                 width='$width'>");
    echo('</a>');


}
?>