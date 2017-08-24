<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";
$conn = mysqli_connect($servername, $username, $password, $dbname); 
if($conn->connect_errno)
	die("error:->".$conn->connect_error);

$Id=$_GET["Id"];
$Name=$_GET["Name"];
$Email=$_GET["Email"];
$Phone=$_GET["Phone"];
$Location=$_GET["Location"];
$sql = "update student SET Name='$Name',Email='$Email',Phone='$Phone',Location='$Location' WHERE Id='$Id'";
$result = mysqli_query($conn,$sql);
if($result){
	header('Location:index.php');
}
else{
	echo "Error in updating";
}
?>