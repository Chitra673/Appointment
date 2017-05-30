<?php
	session_start();
	if(!isset($_SESSION['username'])) header("location:index.html");
	$uid = $_SESSION['username'];
	include "config.php";
	if(!conn)
		die("connection failed".mysqli_connect_error());
	$x=strpos($uid,"N");
	if($x!=0){
		$row=mysqli_fetch_array(mysqli_query($conn,"select name from fac_details where id='$uid'"));
		$name=$row['name'];
	}
	else
		$name=$uid;
	date_default_timezone_set("Asia/Kolkata");
	$res=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from sentbox where sender='$name'")) or die(mysqli_error($conn));
	if($res['cou']>0){
			$i=0;
			echo "<h2 style='text-align:center;margin-top:0.5%;'>Sentbox</h2>";
			echo "<table><tr id='head'><th>S.NO</th><th>Received By</th><th>Sent Date-Time</th><th>Subject</th><th>Status</th></tr>";
			$res=mysqli_query($conn,"select * from sentbox where sender='$name'");
			while($row=mysqli_fetch_array($res)){
				$i++;
				$d=date('Y-m-d');
				echo "<tr><td>".$i."</td><td>".$row['receiver']."</td><td id='date'>".$row['date'].", ".$row['time']."</td><td id='sub'>".$row['reason']."<br/>I wish to meet you on ".$row['app_date']."</td>";
				if($x!=0)
					echo "<td id='a' style='color:#008000;width:15%;'><b>Delivered</b>";
				else if($row['accepted']=="a"){
					echo "<td id='p' style='color:#008000;width:15%;'><b>Accepted</b>";
				}
				else if($row['accepted']=="" and $row['app_date']>=$d){
					echo "<td id='p' style='color:#0000FF;width:15%;'><b>Pending</b>";
				}
				else if($row['accepted']=="n" or $row['app_date']<$d){
					echo "<td id='p' style='color:#FF0000;width:15%;'><b>Rejected</b>";
				}
				echo "</td></tr>";
			}
			echo "</table>";
	}
	else{
		echo "<h3 style='text-align:center;color:red'>Your Sentbox is empty....!!!</h3>";
	}
?>
<style>
table{
		margin: 1% 0% 0% 1.5%;
		border-collapse:collapse;
		width:97%;
	}
	tr{
		font-family:sanserief;
		border-collapse:collapse;
	}
	td,th{
		font-size:20px;
		padding:1%;
		border:1px solid black;
		text-align:center;
	}
	td{
		font-size:19px;
		padding:0.7%
	}
	#head{
		background-color:#7979C9;
		font-size:23px;
	}
	#sub{
		width:30%;
	}
	#date{
		width:22%;
	}
</style>
