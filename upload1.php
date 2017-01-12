<html>
<head>
<title>upload part 1</title>
</head>
<body> 
<center>
<h1>Upload form part 1</h1>
<!--specify form action for html-->
<form action="upload2.php" method="post">
<?php 
//find root path
echo $_SERVER['DOCUMENT_ROOT'];
$docroot = $_SERVER['DOCUMENT_ROOT'];
// create new folder for event
$dirname = trim(date("mdy"));
?>
<!--textarea for inputting folder name with preset of current date.--> 
<p>Folder name?
<input type="text" name="dirname" size="30" maxlength="50" value=" <?php echo$dirname;?> "
<!--upload a file-->
<input type="submit" name="upload2submit" value="Make directory!" />
</form>
</center>
</body>
</html>