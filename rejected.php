<?php
	session_start();
	if(!isset($_SESSION['username'])) header("location:index.html");
	$uid = $_SESSION['username'];
	include "config.php";
	if(!$conn)
		die("connection failed".mysqli_connect_error());
	$sen = mysqli_real_escape_string($conn,$_GET['sen']);
	$rec = mysqli_real_escape_string($conn,$_GET['rec']);
	$d = mysqli_real_escape_string($conn,$_GET['date']);
	$t = mysqli_real_escape_string($conn,$_GET['time']);
	$ad = mysqli_real_escape_string($conn,$_GET['app']);
	date_default_timezone_set("Asia/kolkata");
	$date=date('Y-m-d');
	$time=date('H:i:s');
	mysqli_query($conn,"UPDATE sentbox set accepted='n' WHERE sender='$sen' and receiver='$rec' and date='$d' and time='$t'");
	$rea="Request Accepted";
	if(mysqli_query($conn,"INSERT INTO sentbox values('$rec','$sen','$date','$time','$rea','n','$ad'"))
		echo "hello";
?>
