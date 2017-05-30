<?php
	session_start();
	if(!isset($_SESSION['username'])) header("location:index.html");
	$uid = $_SESSION['username'];
	include "config.php";
	if(!$conn)
		die("connection failed".mysqli_connect_error());
		$x=strpos($uid,"N");
	$fname = mysqli_real_escape_string($conn,$_POST['rname']);
	$me_date = mysqli_real_escape_string($conn,$_POST['meet_date']);
	$reason = mysqli_real_escape_string($conn,$_POST['reason']);
	$x=strpos($uid,"N");
	if($x!=0){
		$row=mysqli_fetch_array(mysqli_query($conn,"select name from fac_details where id='$uid'"));
		$name=$row['name'];
	}
	else 
		$name=$uid;
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d');
    $time= date('H:i:s');
    if($x==0)
		$sql="INSERT INTO sentbox values('$name','$fname','$date','$time','$reason','','$me_date');";
	else
		$sql="INSERT INTO sentbox values('$name','$fname','$date','$time','$reason','a','$me_date');";
	$sql2="INSERT INTO inbox values('$fname','$name','$date','$time','$reason');";
	mysqli_query($conn,$sql2);
	if(mysqli_query($conn,$sql)){
		if($x==0)
			echo "<script>alert('Request sent successfully.....!!!');window.location.href='sentbox.php'</script>";
		else
			echo "<script>alert('Request sent successfully.....!!!');window.location.href='sentbox.php'</script>";
		}
	else
		echo "<script>alert('Request not sent.....!!!');</script>";
?>
