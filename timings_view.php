<?php 
	session_start();
	if(!isset($_SESSION['username'])) header("location:index.html");
	$uid = $_SESSION['username'];
	include "config.php";
	if(!$conn)
		die("connection failed".mysqli_connect_error());
	$facname = mysqli_real_escape_string($conn,$_GET['fac']);
	$user_date = mysqli_real_escape_string($conn,$_GET['date']);
	$facprofile = mysqli_fetch_array(mysqli_query($conn,"select * from fac_details where name = '$facname'")) or die(mysqli_error($conn));
	echo "<h2>".$facname."</h2><hr/>";
	$cur_date=date('Y-m-d');
	$last_date="2017-04-30";
	$day=date('l', strtotime($user_date));
	if($cur_date<=$user_date and $user_date<=$last_date and $day!="Sunday"){
		if($day == "Monday")
			$free_times = mysqli_fetch_array(mysqli_query($conn,"select * from monday where fname = '$facname'")) or die(mysqli_error($conn));
		else if($day == "Tuesday")
			$free_times = mysqli_fetch_array(mysqli_query($conn,"select * from tuesday where fname = '$facname'")) or die(mysqli_error($conn));
		else if($day == "Wednesday")
			$free_times = mysqli_fetch_array(mysqli_query($conn,"select * from wednesday where fname = '$facname'")) or die(mysqli_error($conn));
		else if($day == "Thursday")
			$free_times = mysqli_fetch_array(mysqli_query($conn,"select * from thursday where fname = '$facname'")) or die(mysqli_error($conn));
		else if($day == "Friday")
			$free_times = mysqli_fetch_array(mysqli_query($conn,"select * from friday where fname = '$facname'")) or die(mysqli_error($conn));
		else
			$free_times = mysqli_fetch_array(mysqli_query($conn,"select * from saturday where fname = '$facname'")) or die(mysqli_error($conn));
		$flag=0;
		$arr_len=count($free_times);
		if($arr_len>0)
			echo "<h3>Available Timings on ".$user_date."</h3>";
		if($free_times['first']==""){
			echo "<p>8:30am-10:00am</p>";
			$flag=1;
		}
		if($free_times['second']==""){
			echo "<p>10:00am-11:30am</p>";
			$flag=1;
		}
		if($free_times['third']==""){
			echo "<p>11:30am-1:00pm</p>";
			$flag=1;
		}
		if($free_times['fourth']==""){
			echo "<p>2:00pm-3:30pm</p>";
			$flag=1;
		}
		if($free_times['fifth']==""){
			echo "<p>3:30pm-5:00pm</p>";
			$flag=1;
		}
		if($flag==0)
			echo "<p>No free timings are available on".$user_date."....!!!</p>";
	}
	else{
		echo "<p>".$user_date." is holiday</p>";
	}
	echo "<hr/>";
	echo "<form name='forms' action='request.php' method='post'><table><tr><td>To</td><td>:</td><td><input type='date' value='".$facname."' readonly name='rname'></td></tr>";
	echo "<tr><td>Appointment Date</td><td>:</td><td><input type='date' placeholder='yyyy-mm-dd' id='me_date' name='meet_date'></td></tr>
		<tr><td>Subject</td><td>:</td><td><textarea type='text' placeholder='Type ur reason' id='rea' name='reason'></textarea></td></tr></table><br/>
		<input type='submit' name='sentn' id='sent' value='Send Request'></form>";
?>	

	<style>
	form{
		margin:2% 0% 0% 30%;
		width:50%;
		
	}
	table{
			margin-left:10%;
	}
	tr{
		font-size:20px;	
	}
	input,textarea{
		padding:3%;
		width:100%;
		font-size:15px;
	}
	textarea{
		heigh:30%;
	}
	#sent{
		margin:0% 0% 0% 24%;
		background-color:#34B634;
		color:#FFFFFF;
		font-size:20px;
		padding:0.9%;
		width:35%;
		border:1px solid #008000;
	}
	h2{
		text-align:center;
		color:#0000FF;
	}
	h3{
		text-align:center;
	}
	hr{
		color:#1A1A1A;
		width:50%;	
	}
	p{
		text-align:center;
		font-size:20px;
		color:#000000;
	}
</style>
