<?php 
	session_start();
	if(!isset($_SESSION['username'])) header('location:index.php');
	$uid = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Appointment</title>
		<link href="styles/view.css" type="text/css" rel="stylesheet">
		<style>
		li a, .dropbtn {
			display: inline-block;
			color: white;
			text-align: center;
			text-decoration: none;
		}

		li a:hover, .dropdown:hover .dropbtn {
			background-color:#1E90FF;
		}

		li.dropdown {
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #333333;
			min-width: 200px;
			box-shadow: 0px 8px 16px 0px #1A1A1A;
			z-index: 1;
		}

		.dropdown-content a {
			color:white;
			font-size:20px;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align:align;
		}

		.dropdown-content a:hover {background-color: #f1f1f1;color:black}

		.dropdown:hover .dropdown-content {
			display: block;
		}
		</style>
	</head>
	<body>
			<div id="header">
				<ul>
					<li id="icon">Appointment</li>
					<li id="idnum" class="dropdown">
						<a href="content.php" target="con_frame" id="id_link" class="dropbtn">
						<table id="head_tb"><tr id="head_rw">
						<td class="head_dt"><img src="icons/users.png" width=25px height=25px style="margin:5px 5px 0px 7px;"></td>
						<td class="head_dt"><b>Welcome,<?php echo $uid;?></b></td>
						<td class="head_dt"><img src="icons/downs.png" width=20px height=20px style="margin:5px 0px 0px 0px;"></td></tr></table>
						</a>
						<div class="dropdown-content">
						  <a href="chan_pswd.php" target='con_frame'>change password</a>
						 <!-- <a href="update.php" target='con_frame'>Update profile</a>-->
						  <a href="logout.php">Logout</a>
						</div>
					</li>
				</ul>
			</div>
	</body>
</html>
