<?php
function makeThumbnail($sourcefile, $endfile, $thumbwidth, $thumbheight, $quality) {
    ini_set( "memory_limit","192M");
// Takes the sourcefile (path/to/image.jpg) and makes a thumbnail from it
// and places it at endfile (path/to/thumb.jpg).
// Load image and get image size.
    if (file_exists($sourcefile)) {

        $img = imagecreatefromjpeg($sourcefile);
        $width = imagesx( $img );
        $height = imagesy( $img );

            if ($width > $height) {

            $newwidth = $thumbwidth;
            $divisor = $width / $thumbwidth;
            $newheight = floor( $height / $divisor);
            } else {

            $newheight = $thumbheight;
            $divisor = $height / $thumbheight;
            $newwidth = floor( $width / $divisor );
            }

        // Create a new temporary image.
        $tmpimg = imagecreatetruecolor( $newwidth, $newheight );

        // Copy and resize old image into new image.
        imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );

        // Save thumbnail into a file.
        imagejpeg( $tmpimg, $endfile, $quality);

        // release the memory
        imagedestroy($tmpimg);
        imagedestroy($img);
    } else {
    echo "The file " . $sourcefile . " does not exist";
    }  
}
?>