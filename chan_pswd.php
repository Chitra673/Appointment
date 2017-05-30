<?php
	session_start();
	if(!isset($_SESSION['username'])) header('location:index.php');
	$uid = $_SESSION['username'];
	include 'config.php';
	if(isset($_POST['update']))
	{
		$opswd=$_POST['opswd'];
		$oenc=md5($opswd);
		$npswd=$_POST['npswd'];
		$enc=md5($npswd);
		$x=strpos($uid,"N");
		if(!$conn)
			die("connection failed".mysqli_connect_error());
		if($x==0){
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from stu_reg where id='$uid' and password='$oenc'"));
			$sql="update stu_reg set password='$enc' where id='$uid';";
		}
		else{
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from fac_reg where id='$uid' and password='$oenc'"));
			$sql="update fac_reg set password='$enc' where id='$uid';";
		}
		if($count['cou']>0){
			mysqli_query($conn,$sql);
			echo "<script>alert('Password updated...!!!');window.location.href='content.php'</script>";
		}
		else
			echo "<script>alert('Password not updated...!!!')</script>";
	}
?>
<form name='forms' action='' method='post'>
	<fieldset>
		<legend><b>Chage Password</b></legend>
	<table>
		<tr>
			<td>Current password</td>
			<td>:</td>
			<td><input type='password' required name='opswd'></td>
		</tr>
		<tr>
			<td>New Password</td>
			<td>:</td>
			<td><input type='password' name='npswd' required></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td>:</td>
			<td><input type='password' name='npswd' required></td>
		</tr>
	</table><br/>
	<input type='submit' name='update' id='sent' value='update'></fieldset></form>
<script>
	function validate()
			{	
				if(reg.cpswd.value!=reg.pswd.value)
				{
					alert("Your password and confirm password didn't match");
					reg.cpswd.focus();
					return false;
				}
			}
</script>
<style>
	fieldset{
		margin:10% 0% 0% 25%;
		border:1px solid black;
		width:40%;
		padding:2%;
		background-color:white;
	}
	legend{
		font-size:22px;
		font-style:bold;
		color:#0000FF;
	}
	table{
		width:90%;
		margin-left:10%;
	}
	td{
		font-size:19px;
	}
	input,textarea{
		width:180px;
		height:30px;
		font-size:15px;
		background-color:#F3EBEB;
		border:1px solid #BFBFBF;
	}
	textarea{
		height:80px;
	}
	#sent{
		margin-left:28%;
		background-color:#12B612;
		color:white;
		height:40px;
		font-size:18px;
		border:1px solid black;
	}
</style>
