NEXT STEP: DETERMINE WHICH VARIABLE IS SAVING THE THUMBNAIL INTO THE THE NEW FOLDER. 
DETERMINE THE OUTPUT VALUE, DETERMINE THAT THE PATH EXISTS AND IT'S CORRECT, AND 
DETERMINE THAT YOU'VE PREPENDED THE PATH VARIABLE THAT YOU'RE USING. 

<?php // actual code for upload

require_once 'upload_variables.php';

//create the directory to upload the photos into if it does not exist
    if (file_exists($docroot.$dirname) && is_dir($docroot.$dirname)) { // determines whether or not this particular directory exists
        echo "<p>the ". $mainurl. " folder exists and the photos will be saved into it.</p>";
        } else {
    		echo "the ". $mainurl. " folder doesn't exist. <br />";
            mkdir($docroot.$dirname, 0777);
            mkdir($docroot.$dirname.'/thumbs', 0777);
        }

require_once 'connect.php'; 
require_once 'create_db_table.php';
$sqlselect = "SELECT * from learning2 WHERE location='test2';";
$result = mysql_query($sqlselect) or die(mysql_error());
$thumbwidth = 100;
$thumbheight = 100;

function makeThumbnail($sourcefile, $endfile, $thumbwidth, $thumbheight, $quality) {
    echo $sourcefile;     
    ini_set("memory_limit","192M"); 
    // Takes the sourcefile (path/to/image.jpg)and makes a thumbnail from it // and places it at endfile (path/to/thumb.jpg). 
    // Load image and get image size.     
if (file_exists($sourcefile) && ($sourcefile!='.') && ($sourcefile!='..'))
    {         
        $img = imagecreatefromjpeg($sourcefile);        
        $width = imagesx( $img );         
        $height = imagesy( $img );
        if ($width > $height) 
            {
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
    if (imagejpeg( $tmpimg, $endfile, $quality)) { 
            echo $value.' inserted successfully! </ br>';
        } else {
            echo $value.' not inserted </ br>';
        }
    // release the memory
    imagedestroy($tmpimg);
    imagedestroy($img);
    } else {
    echo "The file " . $sourcefile . " does not exist </ br>"; 
}

//if(isset($_POST['upload2submit'])) {

if($_FILES["zip_file"]["name"]) 
{ // pull the name of the zip file from the upload
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];
    $name = explode(".", $filename); //format the filename for a variable
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) 
    {
        if($mime_type == $type) 
        {
            $okay = true;
                break;
        }
    }
    
    $continue = strtolower($name[1]) == 'zip' ? true : false; // let user know if the zip file has not been uploaded
        if(!$continue) 
        {
            $message = "The file you are trying to upload is not a .zip file. Please try again.";

        $target_path = $dirname."/".$name; // get the $target_path variable to for the move_uploaded_file() function.
            if(move_uploaded_file($source, $target_path)) 
            { // this block extracts the zip files and moves them to the $dirname directory

            $zip = new ZipArchive();
            $x = $zip->open($target_path);
            if ($x === true) {
                $zip->extractTo($dirname."/");
                $images = array();
                for ($i=0; $i<$zip->numFiles; $i++) 
                {
                    $images[] = $zip->getNameIndex($i);
                }
                                
                $zip->close();                 
                unlink($target_path);
            }         
            $message = "Your .zip file was uploaded and unpacked."; }
        } else {            
            $message = "There was a problem with the upload. Please try again.";
        } 
            $newdir = scandir($dirname);     
             foreach ($newdir as $key => $value) {         
                echo $value."</br>";         
                if ($value!='.' && $value!='..') {             
                    $thumburl = $rooturl.$dateurl.'thumbs/'.$value;
                    echo 'Key: ' . "$key;" . ' Value: ' . "$value" ."<br />\n";
                    $sourcefile = trim($value);                     
                    $endfile = 'http://gravenimage.us/test/'.$dirname.'/thumbs/'.$value;
                    //$sourcefile = $dirname."/".$sourcefile;
                    makeThumbnail($dirname.$sourcefile, $endfile, $thumbwidth, $thumbheight, $quality);                 
                    echo $sourcefile;                 
                    echo $endfile;
                    if ($key='1') {           
                    echo "initial 'thumbs' entry omitted. </ br>";                         
                    } else {                      
                        mysql_query("INSERT INTO learning3 (taken, location, subject, rooturl, dateurl, imagename, thumburl) VALUES ('$taken', '$location', '$subject', '$rooturl', '$dateurl', '$value', '$thumburl')");
                        echo "<br />";   
                        echo $thumburl ;                     
                        echo '<img src=".$thumburl.">< /img></br>';                     
                        echo "$value"."inserted successfully!";               
                    }                 
                } else {                     
                if ($value!='.' && $value!='..') {
                    echo $value." not inserted, thumbnail not created.  </ br>";                         
                } else {                         
                    echo $imagejpeg;                         
                }
                echo $insert_sql . '<BR>' . mysql_error();                 
            }             }
        } else { 
            echo 'Please input your data and select a zip file.';     
        } 
        echo '<html>'; 
    }
//}
?> 
     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR...nsitional.dtd"> 
       <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <title>Untitled Document</title> </head>
<body>
<?php
if($message) echo "<p>$message</p>";
if($taken) echo "<p>pictures taken on: " . $taken . "</br>";
if($subject) echo "<p>subject: " . $subject . "</br>";
if($location) echo "<p>location: " . $location . "</br>";
if(($rooturl) && ($dateurl)) echo "<p>directory name: " . $rooturl.$dateurl. "</br>";
//if(is_dir($mainurl))
if (file_exists($docroot.$dirname) && is_dir($docroot.$dirname))
      {echo "directory " .$docroot.$dirname. " exists"; }
	  else
	  {echo "directory ".$docroot.$dirname." does not exist.";}
?>
<form enctype="multipart/form-data" method="post" action="display.php">
         <label for="dirname">Directory to use?: </label> <input name="dirname" size="20" type="text" value="<?php echo $dirname; ?>" /><br />
<label for="taken">When was this taken?:</label> <input name="taken" size="20" type="text" value="<?php echo $dirname; ?>" /><br />
<label for="location">Where was this taken?</label> <input name="location" size="20" type="text" /><br />
<label for="subject">subject?</label> <input name="subject" size="20" type="text" /><br />
<!--< />-->
<input type=hidden name="mainurl" value="<?php echo "http://gravenimage.us/test/".'$dirname;' ?>" />
<label>Choose a zip file to upload: <input type="file" name="zip_file" /></label>
<br />
<input type=submit name='submit' value="Upload" /> 
</form>
</body>
</html>