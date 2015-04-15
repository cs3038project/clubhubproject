<?php
//check if you are login
	session_start();
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		header ("Location: login.php");
	}
?>

<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "clubhub");
	$mysqli=mysqli_connect("localhost","root", "", "clubhub");
	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>

<?php
//create query
	$insertEvent = $connection->prepare("insert event(ename, description, edatetime, location, is_public_e, sponsored_by) value(?,?,?,?,?,?)");
	$insertEvent->bind_param("ssssii", $_POST['ename'], $_POST['descr'],$_POST['edatetime'], $_POST['location'], $_POST['e_is_public'], $_POST['sponsored_by']);
	if($insertEvent->execute()){
		echo "Event: " . $_POST['ename'] . " was posted</br><hr/>";
	}

	
?>


<?php
	echo $_POST['ename'] . "</br>";
	echo $_POST['descr'] . "</br>";
	echo $_POST['edatetime'] . "</br>";
	echo $_POST['location'] . "</br>";
	echo $_POST['e_is_public'] . "</br>";
	echo $_POST['cname'] . "</br>";
?>

<form action="cosponsor.php">
	<INPUT TYPE = 'submit'  value="Add Co-sponsor"><br><br>
</form>

<?php
	mysqli_close($connection);
?>

 <a href="logout.php">logout</a>  <br>
