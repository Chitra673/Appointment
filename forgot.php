<!DOCTYPE html>
<html>
	<head>
		<title>Appointment</title>
		 <meta charset="UTF-8"> 
		<link rel="icon" href="icons/icon.jpg" type="image/x-icon">
		<link rel="stylesheet" href="styles/index.css" type="text/css">
		<link rel="stylesheet" href="styles/reg.css" type="text/css">
		<style>
			p{
				font-size:23px;
				margin:2.5% 0% 0% 44%;
			}
		</style>
	</head>
	<body>
		<div class="head">
			<ul>
				<li id="icon">Appointment</li>
				<li id="sign_id"><b><a id="signin"  href="index.php">Login</a> | <a id="signup"  href="registration.php" disabled>Register</a></b></li>
			</ul>
		</div>
		<div class="forgot">
			<form id="reg_form" name="reg" action="" method="post" onsubmit="return(validate());">
				<table>
					<h2>Forget Password</h2><hr/>
					<tr>
						<td>Univesity ID</td>
						<td><input name="id" type="text" required></td>
					</tr>
					<tr>
						<td>Sequrity Question</td>
						<td><select>
							<option name="sque" value="">select a question</option>
							<option name="sque" value="Your nick name?" checked>Your nick name?</option>
							<option name="sque" value="Your favourite color?">Your favourite color?</option>
							<option name="sque" value="Your best friend?">Your best friend?</option>
							<option name="sque" value="Phone number?">Phone number?</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Answer</td>
						<td><textarea name="ans" placeholder="write your answer"></textarea></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td><input name="pswd" type="password"  required></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td><input name="cpswd" type="password"  required></td>
					</tr>
				</table>
				<div class="button">
					<input id="reg_but" name="forgot" type="submit" value="submit" onmouseenter="mouse_in()" onmouseout="mouse_out()"></br><hr/>
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
					alert("please give correct password");
					reg.cpswd.focus();
					return false;
				}
			}
			function validateemail()
			{
			   var id = document.reg.Email.value;
			   atpos = id.indexOf("@");
			   dotpos = id.lastIndexOf(".");
			   if (atpos < 1 || ( dotpos - atpos < 2 )) 
			   {
				   alert("Please enter correct email ID")
				   document.reg.Email.focus() ;
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
<?php
	//session_start();
	include "config.php";
	if(isset($_POST['forgot']))
	{
		$id=$_POST['id'];
		$passwd=$_POST['pswd'];
		$que=$_POST['sque'];
		$ans=$_POST['ans'];
		$enc=md5($passwd);
		$x=strpos($id,"N");
		if(!$conn)
			die("connection failed".mysqli_connect_error());
		if($x==0){
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from stu_reg where id='$id' and que='$que' and ans='$ans'"));
			if($count['cou']>0){
				$sql="UPDATE stu_reg SET password='$enc' WHERE id='$id'";
				if(mysqli_query($conn,$sql))
					echo "<script>alert('Password Updated...Now you login');window.location.href='index.php'</script>";
				else
					echo "<script>alert('You entered wrong ID or choose wrong question or answer');</script>";
			}
			else "<script>alert('You are not registered...Try to register!!!');window.location.href='registration.php'</script>";
		}
		else{
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from fac_reg where id='$id' and que='$que' and ans='$ans'"));
			if($count['cou']>0){
				$sql="UPDATE fac_reg SET password='$enc' WHERE id='$id'";
				if(mysqli_query($conn,$sql))
					echo "<script>alert('Password Updated...Now you login...!!');window.location.href='index.php'</script>";
				else
					echo "<script>alert('You entered wrong ID or choose wrong question or answer');</script>";
			}
			else "<script>alert('You are not registered...Try to register!!!');window.location.href='registration.php'</script>";
		}
	}
	mysqli_close($conn);
?>
