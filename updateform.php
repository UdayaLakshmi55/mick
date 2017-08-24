<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Form</title>
  <center><i><h1>Edit Here</h1></i></center>
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
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";
 
$link = mysqli_connect($servername, $username, $password,$dbname); 

$Id=$_GET['Id'];
$sql = "SELECT Id, Name, Email,Phone,Location FROM student where Id='$Id'";
$result = mysqli_query($link,$sql) or die(mysqli_error($link));
$row =  mysqli_fetch_row($result);
?>

<body>
  <center>
  <div class="container">
   <form action="update.php" name="StudentRegistration">
<div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="Name" type="text" class="form-control" name="Name"
 value="<?php echo $row[1];?>" size="30" placeholder="Edit your Name">
</tr>
</div>
	<br>

<div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
      <input id="Id" type="text" class="form-control" name="Id" placeholder="Registered Number"
    
 readonly="readonly" value="<?php echo $row[0];?>"  >

</div>
    <br>
	
	
<div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input id="Email" type="text" class="form-control" name="Email"  value="<?php echo $row[2];?>"   placeholder="Edit your mail">
</div>
	<br>

<div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"  ></i></span>
      <input id="Phone" type="text" class="form-control" name="Phone" value="<?php echo $row[3];?>" placeholder="Edit your Phonenumber">
    </div>
	
	<br>

<div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-home" ></i></span>
      <input id="Location" type="text" class="form-control" name="Location" placeholder="Location" value="<?php echo $row[4];?>" placeholder="Edit your Location here">

 </div>
	 <br>
<input type="submit" class="btn btn-success" class="glyphicons glyphicons-log-in" value="Update" onclick="return validate()"></button>
</td>						
</tr>
</table>


</form>
<center>
</body>
</html>