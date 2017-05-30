<h2 style="margin-top:5%;text-align:center">COMPOSE</h2>
<form name='forms' action='request.php' method='post'>
	<table>
		<tr>
			<td>To</td>
			<td>:</td>
			<td><input type='date' placeholder='ID' name='rname'></td>
		</tr>
		<tr>
			<td>Meeting Date</td>
			<td>:</td>
			<td><input type='date' placeholder='yyyy-mm-dd' id='me_date' name='meet_date'></td>
		</tr>
		<tr>
			<td>Subject</td>
			<td>:</td>
			<td><textarea type='text' placeholder='Type ur reason' id='rea' name='reason'></textarea></td>
		</tr>
	</table><br/>
		<input type='submit' name='sentn' id='sent' value='Send Request'></form>
<style>
	form{
		margin:3% 0% 0% 28%;
		border:1px solid black;
		width:40%;
		padding:2%;
		background-color:white;
	}
	table{
		width:90%;
		margin-left:10%;
	}
	td{
		font-size:20px;
	}
	input,textarea{
		width:180px;
		height:30px;
		font-size:15px;
		background-color:#F3EBEB;
		border:1px solid #BFBFBF;
	}
	textarea{
		height:80px;
	}
	#sent{
		margin-left:28%;
		background-color:#12B612;
		color:white;
		height:40px;
		font-size:18px;
		border:1px solid black;
	}
</style>
