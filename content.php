<!DOCTYPE html>
<html>
	<head>
		<link href="styles/content.css" type="text/css" rel="stylesheet">
		<style>
			table{
				margin:2% 0% 0% 10%;
				width:80%;
				border-collapse:collapse;
				height:50%;
			}
			tr{
				border-collapse:collapse;
			}
			th{
				background-color:#ADD8E6;
				padding:1% 2% 1% 2%;
				border:2px solid black;
			}
			td{
				padding:1% 0.5% 1% 0.5%;
				border:2px solid black;
				text-align:center;
				font-size:20px;
			}
			p{
				font-size:30px;
				text-align:center;
				margin-top:3%;
				color:#008000;
			}
			#id_link{
				width:30px;
				padding:0.3%;
				
			}
		</style>
	</head>
	<body>
		<form method="post">
			Search By:
			<input type="radio" name="s_option" value="name" checked>Name
			<input type="radio" name="s_option" value="dep">Department</br>
			<input id="sea" style="width:300px;padding:5px;font-size:15px;height:25px;text-align:center;" type="text" name="sea_val" placeholder="Search faculty here">
			<button id="but_id"  name="submit">submit</button>
		</form>
		<hr style="margin:15px 0px 20px 0px"/>
	</body>
</html>
<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
	include 'config.php';
	if(!$conn)
		die("connection failed".mysqli_connect_error());
	if(isset($_POST['submit'])){
	$i=0;
	$s_val=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['s_option']));
	$type=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sea_val']));
	if($s_val=="name"){
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from fac_details WHERE name rlike '".$type."'")) or die(mysqli_error($conn));
			if($count['cou']>=1){
					$sql="select * from fac_details where name rlike '".$type."'";
					$result=mysqli_query($conn,$sql);
					echo "<table><tr><th style='width:10%'>S.NO</th><th>NAME</th><th>EMAIL</th><th style='width:20%'>PROFILE</th></tr>";
					while($row=mysqli_fetch_array($result)){
						$i++;
						$name  = $row['name'];
						echo "<tr><td>".$i."</td><td name='name_fac'>".$row["name"]."</td><td>".$row["email"]."</td><td id='link_id'><a  href = 'profile_view.php?fac=".$name."' id='id_link' name='pro_link'>view</a></td></tr>";
					}
					echo "</table>";
			}
			else
				echo "<p>No results found...!!!!</p>";
	}
	if($s_val=="dep"){
			$count=mysqli_fetch_array(mysqli_query($conn,"select count(*) as cou from fac_details WHERE dep rlike '".$type."'")) or die(mysqli_error($conn));
			if($count['cou']>=1){
					$sql="select * from fac_details where dep rlike '".$type."'";
					$result=mysqli_query($conn,$sql);
					echo "<table><tr><th style='width:10%'>S.NO</th><th>NAME</th><th>EMAIL</th><th style='width:20%'>PROFILE</th></tr>";
					while($row=mysqli_fetch_array($result)){
						$i++;
						$name  = $row['name'];
						echo "<tr><td>".$i."</td><td name='name_fac'>".$row["name"]."</td><td>".$row["email"]."</td><td id='link_id'><a  href = 'profile_view.php?fac=".$name."' id='id_link' name='pro_link'>view</a></td></tr>";
					}
					echo "</table>";
			}
			else
				echo "<p>No results found...!!!!</p>";
	}
}
?>
