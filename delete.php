<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";
 
$link = mysqli_connect($servername, $username, $password, $dbname);  
if ($link->connect_errno) {
    die("Connection failed: " . $link->connect_error);
} 
$Id=$_GET["Id"];
$sql = "DELETE FROM student WHERE Id='$Id'";
$result = mysqli_query($link,$sql) or die(mysqli_error($link));
if($result)
{
	header('Location:index.php');
}

?>