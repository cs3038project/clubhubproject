<?php
//check if you are login
	session_start();
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		header ("Location: login.php");
	//get the pid
	$personId= $_SESSION['userName']; 
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
	$checkAdmin = $connection->prepare("SELECT clubid FROM role_in WHERE pid=? and role='Admin'");
	$checkAdmin->bind_param("i", $personId);
	$checkAdmin->execute();
	$checkAdmin->bind_result($clubid);
	if(!$checkAdmin){
		die("Database checkAdmin query access fail");
	};
	$showEvent = $connection2->prepare("SELECT eid, ename, sponsored_by, count(pid) FROM event natural join sign_up WHERE sponsored_by=? GROUP BY eid");
	$showEvent->bind_param("i", $sponsorID);
?>

<?php

	while($checkAdmin->fetch()){
		echo 'TESTING' . "</br>";
		echo 'clubID: ' . $clubid . "</br>";
		$sponsorID=$clubid;
		$showEvent->execute();
		$showEvent->bind_result($eid, $ename, $sponsored_by, $count);
		
		while($showEvent->fetch()){
			echo 'Eid: ' . $eid . "</br>";
			echo 'Ename: ' . $ename . "</br>";
			echo 'Sponsored By: ' .  $sponsored_by . "</br>";
			echo 'Amount that signed up: ' . $count . "</br><hr/>";
		}
	}
?>


<?php
	mysqli_close($connection);
?>
