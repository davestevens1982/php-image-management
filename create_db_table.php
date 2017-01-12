<?php //Create sql table with date as name
$dirname = trim($_POST['dirname']);
// Create connection
require_once 'connect.php'; 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else { 
    echo "connected successfully to database.";
}

//sql to create table
$sql = "CREATE TABLE $dirname (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
taken DATE,
location varchar(255),
subject varchar(255),
mainurl varchar(255),
rooturl varchar(255),
dateurl varchar(255),
email varchar(255),
)";

// mysql> CREATE TABLE $dirname (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// location varchar(255),
// subject varchar(255),
// mainurl varchar(255),
// rooturl varchar(255),
// dateurl varchar(255),
// email varchar(255),
// );

//if ($conn->query($sql) === TRUE) {
//    echo "Table $dirname created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>