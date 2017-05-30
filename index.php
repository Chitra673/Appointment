<?php
	session_start();
	if(isset($_POST['login'])){
		include "config.php";
		$uid=$_POST['uid'];
		$x=strpos($uid,"N");
		$passwd=$_POST['password'];
		$cpasswd=md5($passwd);
		if(!$conn)
			die("connection failed".mysqli_connect_error()); 
		if($uid=='officeN'){
			$count=mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as cou FROM office WHERE password='$cpasswd' and id = 'officeN '")) or die(mysqli_error($conn));
			if($count['cou']>0){
				$_SESSION['username'] = $uid;
				echo "<script>alert('Login Successfully...!');window.location.href='office.php'</script>";
			}
		}
		else if($x==0){
			$count=mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as cou FROM stu_reg WHERE password='$cpasswd' and id = '$uid'")) or die(mysqli_error($conn));
			if($count['cou']>0){
				$_SESSION['username'] = $uid;
				echo "<script>alert('Login Successfully...!');window.location.href='stu_view.php'</script>";
			}
			else
				echo "<script>alert('You entered wrong input...');window.location.href='index.php'</script>";
		}
		else{
			$count=mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as cou FROM fac_reg WHERE password='$cpasswd' and id = '$uid'")) or die(mysqli_error($conn));
			if($count['cou']>0){
				$_SESSION['username'] = $uid;
				echo "<script>alert('Login Successfully...!');window.location.href='fac_view.php'</script>";
			}
			else
				echo "<script>alert('You entered wrong input....');window.location.href='index.php'</script>";
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
		<link rel="stylesheet" href="styles/login.css" type="text/css">
	</head>
	<body>
		<div class="head">
			<ul>
				<li id="icon">Appoinment</li>
				<li id="sign_id"><b><a id="signin"  href="index.php">Login</a> | <a id="signup"  href="registration.php">Register</a></b></li>
			</ul> 
		</div>
		<div class="login">
			<h2>LOGIN</h2><hr/>
			<form id="login_form" action="index.php" method="post" onsubmit="return(validate());">
				<table>
					<tr>
						<td class="img"><img src="icons/user2.png" alt="uid" width="25px" height="22px" style="margin-top:-10px;border:1px solid black;padding:8px 5px 9px 5px"></td>
						<td class="input"><input class="login_ip" type="text" name="uid" placeholder="ID" required></td>
					</tr>
					<tr style="margin-top:10px;">
						<td class="img"><img src="icons/lock.png" alt="uid" width="22px" height="22px" style="margin-top:-10px;border:1px solid black;padding:8px 5px 9px 8px"></td>
						<td class="input"><input class="login_ip" type="password" name="password" placeholder="password" required></td>
					</tr>
				</table>
					<div class="button">
						<input id="log_but" name="login" type="submit" value="Login" onmouseenter="mouse_in()" onmouseout="mouse_out()"></br><hr/>
						<a href="forgot.php" id="forgot">Forget Password..?</a>
					</div>
			</form>
		</div>
		<script>
			function validate(){
				if(reg.id.value.length!=7){
						alert("You entered wrong ID");
						reg.id.focus();
						return false;
					}
			}
			document.getElementById("signin").style.color="#FFFFFF";
			document.getElementById("signup").style.color="#BFBFBF";
			function mouse_in(){
					document.getElementById('log_but').style.background='#556574';
			}
			function mouse_out(){
					document.getElementById('log_but').style.background='#2C3E50';
			}
		</script>
	</body>
</html>
