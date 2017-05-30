<?php 
	session_start();
	if(!isset($_SESSION['username'])) header('location:index.php');
	$uid = $_SESSION['username'];
	include "config.php";
	$row=mysqli_fetch_array(mysqli_query($conn,"select * from stu_reg where id='$uid'"));
	$path=$row['filepath'];
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
		  <div id="nav_div">
				<img id="photo" src="upload/<?php echo $path;?>">
				<table id="nav_table">
					<tr class="nav_tr" id='inbox' onmouseenter="menter(1)" onmouseout="mout(1)">
						<td class="nav_dt1"><a class="nav_a" href="inbox.php" target="con_frame"><img width=20px height=20px style="float:right;padding:0px 8px 0px 10px" class="td_img" src="icons/mails.png"></td>
						<td class="nav_dt2">Inbox</a></td>
					</tr>
					<tr class="nav_tr" id='sentbox' onmouseenter="menter(2)" onmouseout="mout(2)">
						<td class="nav_dt1"><a class="nav_a" href="sentbox.php" target="con_frame"><img width=20px style="float:right;padding-right:9px" height=20px class="td_img" src="icons/mails.png"></td>
						<td class="nav_dt2">Sentbox</a></td>
					</tr>
					<tr class="nav_tr" id='trash' onmouseenter="menter(3)" onmouseout="mout(3)">
						<td class="nav_dt1"><a class="nav_a" href="trash.php" target="con_frame"><img width=22px style="float:right;padding-right:5px" height=22px class="td_img" src="icons/trash6.png"></td>
						<td class="nav_dt2">Trash</a></td>
					</tr>
				</table>
		</div>
		<div id="con_div">
			<iframe src="content.php" name="con_frame"></iframe>
		</div>
		<div id="foot">
			<footer>&copy;N120677, N120693, N110600, N120673</footer>
		</div>
		<script>
			function mout($x){
				if($x==1)
					document.getElementById('inbox').style.background="#ADD8E6";
				if($x==2)
					document.getElementById('sentbox').style.background="#ADD8E6";
				if($x==3)
					document.getElementById('trash').style.background="#ADD8E6";
			}
			function menter($x){
				if($x==1)
					document.getElementById('inbox').style.background="#65B9D4";
				if($x==2)
					document.getElementById('sentbox').style.background="#65B9D4";
				if($x==3)
					document.getElementById('trash').style.background="#65B9D4";
			}
			function id_back(){
				document.getElementById('idnum').style.background="#0000FF";
			}
		</script>
	</body>
</html>

