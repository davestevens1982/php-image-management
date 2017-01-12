<?php
define(DATABASE_HOST, "gravid.db.2460873.hostedresource.com");
define(DATABASE_USERNAME, "gravid");
define(DATABASE_PASSWORD, "Learning1");
define(DATABASE_NAME, "gravid");

$servername="gravid.db.2460873.hostedresource.com";
$username="gravid";
$password="Learning1";
$dbname="gravid";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>