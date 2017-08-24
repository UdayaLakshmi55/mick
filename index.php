<!DOCTYPE html>
<html lang="en">
<head>
  <title>Start</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
			function deleterecord(Id)
			{
				 if(confirm('Are u sure to delete the record:'+Id))
				 {
					window.location.href='delete.php?Id='+Id;
				 }
			}
			</script>
			<script type="text/javascript">
		 function active(Id){
			if(Id!=null){
				// alert(document.getElementById("#"+Id));
			     Id.className +=" colorchange";
				//alert(id);
			}
			 
			 
		 }
		</script>
	</script>
	<style>
.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
  </head>
  <body>
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
$i=0;
$var=1;
global $limitvalue;
$value=1;
$sql = "SELECT Name, Id, Email,Phone,Location FROM student";
if(isset($_GET['page']) && $_GET['page']=="first"){
	$sql="SELECT Name, Id, Email,Phone,Location FROM student ORDER BY id ASC LIMIT 5 OFFSET 0";
} 
else if(isset($_GET['page']) && $_GET['page']=="last"){
	$result=$conn->query("SELECT count(*) as total from student");
	$data=$result->fetch_assoc();
	$total=$data['total'];
	$lastFive=$total-5;
	$sql="SELECT Name,Id, Email,Phone,Location FROM student ORDER BY Id ASC LIMIT 5 OFFSET $lastFive";
}
if(isset($_GET['pages'])){
	$page=$_GET['pages'];
	if($page==""||$page==1){
		$page1=0;
		$next=1;
	}else{
		$page1=($page*5)-5;
		$next=$page;
	}
	$sql="SELECT Name,Id, Email,Phone,Location FROM student ORDER BY Id ASC LIMIT $page1,5";
}
$result = $conn->query($sql);
?>

<center><h1>Registered Students</h1></center>
<center>
<table class="table table-striped" width= "2000px" cellspacing="30" cellpadding="20" align="center">
   <tr  style="background-color:#8FAABA;">
     <th>Name</th>
	 <th>Id</th>
	 <th>Email</th>
	 <th>Phone</th>
	 <th>Location</th>
	 <th>Edit Data</th>
	 <th>Delete Data</th>
   </tr>
  
<?php

if($result)
{
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
?>
     <tr>
    <td><?php echo $row["Name"];?></td>
	<td><?php echo $row["Id"];?></td>
	<td><?php echo $row["Email"];?></td>
	<td><?php echo $row["Phone"];?></td>
	<td><?php echo$row["Location"]?></td>
	<td><a href="updateform.php?Id=<?php echo $row['Id'] ?>">Edit</a></td>
	<td><a href="javascript:deleterecord(<?php echo $row['Id']; ?>)">Delete</a></td>
            
	</tr>
<?php } }  }?>
</center>

</table>

<center><div class="pagination">
  <a href="index.php?page=first" id="doublearrow">&laquo;</a>
  <?php
  
  if(isset($_GET['pages'])){
       $var=$next-1;
  ?>
  <a href="index.php?pages=<?php echo $var;?>"><span class="glyphicon glyphicon-chevron-left"></span></a>
  <?php  
    }
	else {
   ?>
    <a href="index.php" style="color:black;" ><span class="glyphicon glyphicon-chevron-left"></span></a>
   <?php
	}
  ?>
  <?php 
       $result=$conn->query("SELECT count(*) as total from student");
	   $data=$result->fetch_assoc();
	   $total=$data['total'];
	   $n=$total/5;
	   $n=ceil($n);
       for($i=1;$i<=$n;$i++){
   ?>
        <a class="aclass" id="<?php echo 'pages'.$i;?>" href="index.php?pages=<?php echo $i;?>" onclick="active(this.Id);"><?php echo $i;?></a>
   <?php
    }
	if(isset($_GET['pages'])){
		
		$colorchange=$_GET['pages'];
		if($colorchange==1){
	?>
	    <style>
		#pages1{
			color:#fff;
			background-color:#7FC3EC;
			border-radius:5px;
		}
		</style>
	<?php
		} else if($colorchange==2){
 	?>
	    <style>
		#pages2{
			border-radius:5px;
			color:#fff;
			background-color:#7FC3EC;
		}
		</style>
	<?php
		}
		else if($colorchange==3){
 	?>
	    <style>
		#pages3{
			border-radius:5px;
			color:#fff;
			background-color:#7FC3EC;
			
		}
		</style>
	<?php
		}
	$var=$next+1;
	}
	// echo $var;
	//if($var!=$n) {
   ?>
	
    <a href="index.php?pages=<?php echo $var; ?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
   
  <a href="index.php?page=last" id="doublearrow">&raquo;</a>
  
</div>

</center>

<ul class="pager">
  <li class="previous"><a href="index.php?pages=<?php echo $var; ?>">Previous</a></li>
  <li class="next"><a href="index.php?pages=<?php echo $var; ?>">Next</a></li>
</ul>
<center><button type="button" class="btn btn-success" ><a href="insertion.html">AddStudent<onclick="return validate()" ></button></center>
</body>
</html>