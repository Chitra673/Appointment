<?php
	session_start();
	if(!isset($_SESSION['username'])) header('location:index.php');
	$uid = $_SESSION['username'];
	if(!conn)
		die("connection failed".mysqli_connect_error());
	$cls=$_POST['yr'];
	if($cls=='E3'){
			echo "<h3>E3 CR LIST</h3>";
			echo "<table><tr id='head'><th style='width:10%;'>S.NO</th><th id='send'>ID</th><th id='date'>NAME</th></th><th id='sub'>Email</th><th>Mobile</th><th>class</th>";
			echo "<tr><td>1</td><td>N120701</td><td>Ajay.M<td>ajaylmars97@gmail.com</td><td>8975341012</td><td>CSE-03</td>";
			echo "<tr><td>2</td><td>N120673</td><td>Shakuntala.L<td>sakuntala243@gmail.com</td><td>8096641923</td><td>CSE-03</td>";
		}
	else
		echo "<p>Data will be provided later...!!!<p>"
?>
<style>
	#head{
		background-color:#7F7F7F;
	}
	h3{
		text-align:center;
		color:#0000FF;
	}
	p{
		text-align:center;
		margin-top:5%;
		font-size:20px;
		color:red;
	}
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
</style>
