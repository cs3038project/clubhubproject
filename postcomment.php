<?php
//check if you are login
	session_start();
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		header ("Location: login.php");
	}
	//get user id
	$userid= $_SESSION['userName']; 
?>

<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "clubhub");
	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>

<form action="newcomment.php" method="post">
	Commenter: <input type="text" name="commenter" value=<?php $userid; ?> /><br><br>
	Comment: <textarea name="ctext" rows="5" cols="40"></textarea><br><br>			
	Is it Public:
		<input type="radio" name="c_is_public" value="1" checked>Yes 
		<input type="radio" name="c_is_public" value="0">No <br><br>
	<input type="submit" name="submit" value="Post Event" />
</form>

<?php
	mysqli_close($connection);
?>
