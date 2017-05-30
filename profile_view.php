<?php 
	session_start();
	if(!isset($_SESSION['username'])) header("location:index.html");
	include "config.php";
	$facname = mysqli_real_escape_string($conn,$_GET['fac']);
	$facprofile = mysqli_fetch_array(mysqli_query($conn,"select * from fac_details where name = '$facname'")) or die(mysqli_error($conn));
	echo "<p><b>".$facprofile['name']."</b></p><hr/>";
	echo "<table><tr><th>Department</th><td>:</td><td>".$facprofile['dep']."</td></tr>";
	echo "<tr><th>Email-ID</th><td>:</td><td>".$facprofile['email']."</td></tr>";
	echo "<tr><th>Mobile</th><td>:</td><td>".$facprofile['phone']."</td></tr>";
	echo "<tr><th>Cabin</th><td>:</td><td>".$facprofile['cabin']."</td></tr>";
	echo "<tr><th>Research Areas</th><td>:</td><td>".$facprofile['res_area']."</td></tr>"; 
?>
	<tr><th>Available Timings</th><td>:</td><td><form name="forms"><input id='date' type='date' placeholder='yyyy-mm-dd' name='time'></form></td></tr></table>
	<br/><br/><?php $facname = $facprofile['name']; ?>
	<a onclick="send('<?php echo $facname?>','date')" >Available Timings</a>
	<script>
	  function send(facname,dateid) { 
	  var date = document.getElementById(dateid).value;
	  if(date)
		window.location.href = "timings_view.php?fac="+facname+"&date="+date;  
	  else{
		alert("You didn't enter date...!!!");
		forms.time.focus();
		}
	}				
 </script>	
<style>
	hr{
		color:#1A1A1A;
		width:50%;
	}
	p{
		margin-top:2%;
		text-align:center;
		font-size:25px;
		color:#0000FF;
	}
	table{
		margin:0% 0% 0% 25%;
		border-collapse:collapse;
		width:50%;
	}
	tr{
		font-size:22px;
		font-family:sanserief;
		border-collapse:collapse;
	}
	td,th{
		padding:2%;
		text-align:center;
	}
	input{
		width:80%;
		height:40px;
		text-align:center;
		font-size:15px;
	}
	a{
		margin-left:39%;
		color:#FFFFFF;
		background-color:#2FB22F;
		font-size:22px;
		border:1px solid black;
		padding:0.7% 4% 0.7% 4%;
		text-decoration:none;
	}
	a:hover{
		background-color:#34E234;
	}
</style>
