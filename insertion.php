<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
} 
$N=$_POST['Name'];
$I=$_POST["Id"];
$E=$_POST["Email"];
$P=$_POST["Phone"];
$L=$_POST["Location"];
$sql="INSERT INTO student(Name,Id,Email,Phone,Location) VALUES ('$N','$I','$E','$P','$L')";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
if($result){
	header('Location:index.php');
}
else{
	echo "Error";
}
?>