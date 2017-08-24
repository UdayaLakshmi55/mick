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
	<script type="text/javascript" >
function validate()
{ 
var Id=document.getElementById("Id").value;
				var Name=document.getElementById("Name").value;
				var Email=document.getElementById("Email").value;
				var Phone=document.getElementById("Phone").value;
				var Location=document.getElementById("Location").value;
				var checkId=/^[0-9]{1,5}$/;
				var checkNname = /^[A-Za-z ]{3,20}$/;
				var checkPhn = /^[0-9]{10}$/;
				
   if( document.StudentRegistration.Name.value == "" )
   {
     alert( "Please provide your Name!" );
     document.StudentRegistration.Name.focus() ;
     return false;
   }
   if (!checkNname.test(Name)) {
		  alert("Please Enter a valid Name");
return false;		  
		 }
   if (!checkId.test(Id)) {
		  alert("Please Enter Valid Id");
		return false; 
		 }
		if (!checkPhn.test(Phone)&& Phone.length!=10) {
		 alert("Please Enter Valid PhoneNumber");
		return false; 
		 }
		 
   if( document.StudentRegistration.Id.value == "" )
   {
     alert( "It is mandatory to provide ur Id!" );
     document.StudentRegistration.Id.focus() ;
     return false;
   }
   
   if( document.StudentRegistration.Phone.value == "" )
   {
     alert( "Please provide your Phone number!" );
     document.StudentRegistration.Phone.focus() ;
     return false;
   }
   if( document.StudentRegistration.Location.value == "" )
   {
     alert( "Please provide your Location!" );
     document.StudentRegistration.Location.focus() ;
     return false;
   }
   var email = document.StudentRegistration.Email.value;
  atpos = email.indexOf("@");
  dotpos = email.lastIndexOf(".");
 if (email == "" || atpos < 1 || ( dotpos - atpos < 2 )) 
 {
     alert("Please enter correct email ID")
     document.StudentRegistration.Email.focus() ;
     return false;
 }


return true ;


}



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
	<td><a href="updateform.php?Id=<?php echo $row['Id'] ?>">Edit</a></button>
	


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
  <a href="iii.php?pages=<?php echo $var;?>"><span class="glyphicon glyphicon-chevron-left"></span></a>
  <?php  
    }
	else {
   ?>
    <a href="iii.php" style="color:black;" ><span class="glyphicon glyphicon-chevron-left"></span></a>
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
        <a class="aclass" id="<?php echo 'pages'.$i;?>" href="iii.php?pages=<?php echo $i;?>" onclick="active(this.Id);"><?php echo $i;?></a>
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
	
	
   ?>
	
    <a href="iii.php?pages=<?php echo $var; ?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
   
  <a href="iii.php?page=last" id="doublearrow">&raquo;</a>
  
</div>

</center>

<ul class="pager">
  <li class="previous"><a href="iii.php?pages=<?php echo $var; ?>">Previous</a></li>
  <li class="next"><a href="iii.php?pages=<?php echo $var; ?>">Next</a></li>
</ul>
   <form action="insertion.php" method="post" name="StudentRegistration">
<center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">AddStudent<onclick="return validate()" ></button></center>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registration Form</h4>
        </div>
        <div class="modal-body">
          <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="Name" type="text" class="form-control" name="Name" placeholder="Name">
    </div>
	<br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
      <input id="Id" type="text" class="form-control" name="Id" placeholder="Registered Number">
    </div>
    <br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input id="Email" type="text" class="form-control" name="Email" placeholder="Email">
    </div>
	<br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"  ></i></span>
      <input id="Phone" type="text" class="form-control" name="Phone" placeholder="Mobile Number">
    </div>
	
	<br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-home" ></i></span>
      <input id="Location" type="text" class="form-control" name="Location" placeholder="Location">
    </div>
	 <br>

 <input type="submit" class="btn btn-success" class="glyphicons glyphicons-log-in" value="Register" onclick="return validate()">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>









</form>
</body>
</html>