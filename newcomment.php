<?php
//check if you are login
	session_start();
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		header ("Location: login.php");
	}
	//get userid
	$userid = $_SESSION['userName']
?>

<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "clubhub");
	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>
<?php
//create query
	$insertComment = $connection->prepare("insert comment(commenter, ctext, is_public_c) value(?,?,?)");
	$insertComment->bind_param("ssi", $userid, $_POST['ctext'], $_POST['c_is_public']);
	if($insertComment->execute()){
		echo " Your comment was posted</br><hr/>";
	}
?>


<?php
	echo $_POST['ctext'] . "</br>";
	echo $_POST['c_is_public'] . "</br>";
?>

<?php
	mysqli_close($connection);
?>

 <a href="logout.php">logout</a>  <br>
