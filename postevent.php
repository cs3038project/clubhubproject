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
	$connection2=mysqli_connect("localhost","root", "", "clubhub");
	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>
<?php
//create query
	$checkAdmin = $connection->prepare("SELECT cname FROM role_in natural join club WHERE pid=? and role='Admin'");
	$checkAdmin->bind_param("s", $userid);
	$checkAdmin->bind_result($cname);
?>
<?php
	$checkAdmin->execute();
	if($checkAdmin->fetch()){
		$checkAdmin->free_result();
?>
		<form action="newevent.php" method="post">
			Event Name: <input type="text" name="ename" value="" required /><br><br>
			Description: <textarea name="descr" rows="5" cols="40"></textarea><br><br>
			Date and Time: <input type="datetime-local" name="edatetime" value="" /><br><br>
			Location: <input type="text" name="location" value="" /><br><br>				
			Is it Public:
				<input type="radio" name="e_is_public" value="1" checked>Yes 
				<input type="radio" name="e_is_public" value="0">No <br><br>
			Sponsor by: <input type="number" name="cname" value="" required /><br><br>

			<input type="submit" name="submit" value="Post Event" />
		</form>

<?php
	}
	else{
		echo "Sorry you are not an admin. You can't post new event";
	}
?>



<?php
	mysqli_close($connection);
	mysqli_close($connection2);
?>

 <a href="logout.php">logout</a>  <br>
