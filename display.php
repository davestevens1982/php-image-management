<?php
// 1.CONNECT TO DATABASE
// 2.select entries from database from a certain date
// 3.display those entries.

require_once 'connect.php';
$sqlselect = "SELECT * from learning3 WHERE location='loaf';";

//$result = mysql_query($sqlselect) or die(mysql_error());
//$thumbwidth = 100;
//$thumbheight = 100;
//
//function makeThumbnail($sourcefile, $endfile, $thumbwidth, $thumbheight, $quality) {
//    ini_set( "memory_limit","192M");
//// Takes the sourcefile (path/to/image.jpg) and makes a thumbnail from it
//// and places it at endfile (path/to/thumb.jpg).
//// Load image and get image size.
//    $img = imagecreatefromjpeg($sourcefile);
//    $width = imagesx( $img );
//	$height = imagesy( $img );
//
//if ($width > $height) {
//    $newwidth = $thumbwidth;
//    $divisor = $width / $thumbwidth;
//    $newheight = floor( $height / $divisor);
//}
//else {
//    $newheight = $thumbheight;
//    $divisor = $height / $thumbheight;
//    $newwidth = floor( $width / $divisor );
//}
//
//// Create a new temporary image.
//$tmpimg = imagecreatetruecolor( $newwidth, $newheight );
//
//// Copy and resize old image into new image.
//imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
//
//// Save thumbnail into a file.
//imagejpeg( $tmpimg, $endfile, $quality);
//
//// release the memory
//imagedestroy($tmpimg);
//imagedestroy($img);
//}

while($row = mysql_fetch_array($result)){
$sourcefile = $row['rooturl'].$row['dateurl'].$row['imagename'];
$endfile = $row['thumburl'];
echo $endfile;
echo "<br />";
//makeThumbnail($sourcefile, $endfile, $thumbwidth, $thumbheight, $quality);
echo "<br />";
	echo "<img src=".$row['thumburl']."";
	echo "<br />";
}
?>