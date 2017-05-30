<?php
	session_start();
	include 'config.php';
	if(isset($_POST['register']))
	{
		$id=$_POST['id'];
		$email=$_POST['email'];
		$passwd=$_POST['pswd'];
		$que=$_POST['sque'];
		$ans=$_POST['ans'];
		$filename = $_FILES['file']['name'];
		$target = 'upload/'.$filename;
		move_uploaded_file($_FILES['file']['tmp_name'],$target);
		$enc=md5($passwd);
		$x=strpos($id,"N");
		if(!$conn)
			die("connection failed".mysqli_connect_error());
		if($x==0){
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from stu_reg where id='$id'"));
			$sql="INSERT INTO stu_reg values('$id','$enc','$que','$ans','$email','$filename');";
		}
		else{
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from fac_reg where id='$id'"));
			$sql="INSERT INTO fac_reg values('$id','$enc','$que','$ans','$email','$filename');";
		}
		if($count['cou']>0)
			echo "<script>alert('Already registered....!!!');window.location.href='index.php'</script>";
		else{
			if(mysqli_query($conn,$sql))
				echo "<script>alert('Successfully registered....!!!');window.location.href='index.php'</script>";
			else
				echo "<script>alert('Not Successfully registered....!!!')</script>".mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Appointment</title>
		 <meta charset="UTF-8"> 
		<link rel="icon" href="icons/icon.jpg" type="image/x-icon">
		<link rel="stylesheet" href="styles/index.css" type="text/css">
		<link rel="stylesheet" href="styles/reg.css" type="text/css">
	</head>
	<body>
		<div class="head">
			<ul>
				<li id="icon">Appointment</li>
				<li id="sign_id"><b><a id="signin"  href="index.php">Login</a> | <a id="signup"  href="registration.php" disabled>Register</a></b></li>
			</ul>
		</div>
		<div class="reg">
			<form id="reg_form" name="reg" action="" method="post" onsubmit="return(validate());" enctype="multipart/form-data">
				<table>
					<h2>Registration</h2><hr/>
					<tr>
						<td>Univesity ID</td>
						<td><input name="id" type="text" required></td>
					</tr>
					<tr>
						<td>Email-ID</td>
						<td><input name="email" type="text"  required></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input name="pswd" type="password"  required></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td><input name="cpswd" type="password"  required></td>
					</tr>
					<tr>
						<td>Sequrity Question</td>
						<td><select required name="sque">
							<option name="sque" value="">select a question</option>
							<option name="sque" value="Your nick name?">Your nick name?</option>
							<option name="sque" value="Your favourite color?">Your favourite color?</option>
							<option name="sque" value="Your best friend?">Your best friend?</option>
							<option name="sque" value="Phone number?">Phone number?</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Answer</td>
						<td><textarea name="ans" placeholder="write your answer" required></textarea></td>
					</tr>
					<tr>
						<td>Upload Photo</td>
						<td><input type="file" name="file" id="fileId"></td>
					</tr>
				</table>
				<div class="button">
					<input id="reg_but" name="register" type="submit" value="Register" onmouseenter="mouse_in()" onmouseout="mouse_out()"></br><hr/>
					<a href="index.php" id="index">Already a member?</a>
				</div>
			</form>
		</div>
		<script>
			function validate()
			{	
				if(reg.id.value.length!=7){
					alert("You entered wrong ID");
					reg.id.focus();
					return false;
				}
				var e=validateemail();
				 if(e==false )
				 {
					 return false;
				 }
				if(reg.cpswd.value!=reg.pswd.value)
				{
					alert("Your password and confirm password didn't match");
					reg.cpswd.focus();
					return false;
				}
			}
			function validateemail()
			{
			   var id = document.reg.email.value;
			   atpos = id.indexOf("@");
			   dotpos = id.lastIndexOf(".");
			   if (atpos < 1 || ( dotpos - atpos < 2 )) 
			   {
				   alert("Please enter correct email ID")
				   document.reg.email.focus() ;
				   return false;
			   }
			   return( true );
			}
			document.getElementById("signin").style.color="#BFBFBF";
			document.getElementById("signup").style.color="#FFFFFF";
			function mouse_in(){
					document.getElementById('reg_but').style.background='#556574';
			}
			function mouse_out(){
					document.getElementById('reg_but').style.background='#2C3E50';
			}
		</script>
	</body>
</html>

