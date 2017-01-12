<?php // actual code for upload
$dirname = trim($_POST['dirname']);
$taken = trim($_POST['taken']);
$location = trim($_POST['location']);
$subject = trim($_POST['subject']);
$rooturl = "http://gravenimage.us/test/";
$dateurl = $dirname.'/';
$mainurl = $rooturl.$dateurl;
$docroot = $_POST['docroot'];
?>