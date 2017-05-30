<?php
	session_start();
	if(!isset($_SESSION['username'])) header("location:index.html");
	$uid = $_SESSION['username'];
	$x=strpos($uid,"N");	
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
	$res=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from sentbox where receiver='$name'")) or die(mysqli_error($conn));
	if($res['cou']>0){
			$i=0;
			echo "<h2 style='text-align:center;margin-top:0.5%;'>Inbox</h2>";
			echo "<table><tr id='head'><th style='width:10%;'>S.NO</th><th id='send'>Sent By</th><th id='date'>Sent Date-Time</th><th id='sub' style='width:35%'>Subject</th>";
			if($x!=0){
				echo "<th>Status</th>";
				//echo "<th id='del'>Delete</th>";
			}
			echo "</tr>";
			$res=mysqli_query($conn,"select * from sentbox where receiver='$name'");
			while($row=mysqli_fetch_array($res)){
				$i++;
				echo "<tr><td style='width:10%;'>".$i."</td><td>".$row['sender']."</td><td>".$row['date'].", ".$row['time']."</td><td>".$row['reason'].". I wish to meet you on ".$row['app_date']."</td>";
				if($x!=0){
					if($row['accepted']=='a'){
						echo "<td><button style='background-color:#008000;padding:5px;color:#FFFFFF;border:1px solid black'>Accepted</button>";
						echo "<button style='padding:5px;border:1px solid black' disabled>Rejected</button></td>";
					}
					else if($row['accepted']=='n'){
						echo "<td><button style='padding:5px;border:1px solid black' disabled>Accepted</button>";
						echo "<button style='padding:5px;background-color:#E21919;border:1px solid black;color:#FFFFFF'>Rejected</button></td>";
					}
					else{
					?>
					<td><button id='accept' style='padding:5px;border:1px solid black' onclick="accept('accept','delete','<?php echo $row['app_date']?>','<?php echo $row['receiver']?>','<?php echo $row['sender']?>','<?php echo $row['date']?>','<?php echo $row['time']?>')">Accept</button>
					<button id='delete' style='padding:6px;border:1px solid black' onclick="reject('delete','accept','<?php echo $row['app_date']?>','<?php echo $row['receiver']?>','<?php echo $row['sender']?>','<?php echo $row['date']?>','<?php echo $row['time']?>')">Reject</button></td>
				<?php }}
				echo "</tr>";
			}
			echo "</table>";
	}
	else{
		echo "<h3 style='text-align:center;color:red'>Your Inbox is empty....!!!</h3>";
	}
?>
<script>
	function accept(id,id2,ad,r,s,d,t){
		window.location.href="accept.php?sen="+s+"&rec="+r+"&date="+d+"&time="+t+"&app="+ad;
	}
	function reject(id,id2,ad,r,s,d,t){
		window.location.href="rejected.php?sen="+s+"&rec="+r+"&date="+d+"&time="+t+"&app="+ad;
	}
</script>
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
		font-size:18px;
		padding:0.9%;
		border:1px solid black;
		text-align:center;
	}
	#head,th{
		background-color:#7979C9;
		font-size:20px;
		padding:0.8%;
	}
	#send{
		width:15%;
	}
	#date{
		width:20%;
	}
	#del{
		width:10%;
	}
</style>
