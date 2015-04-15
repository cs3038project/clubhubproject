<?php
//check if you are login
	session_start();
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		header ("Location: login.php");
?>

<?php
//connect to database
	$connection1=mysqli_connect("localhost","root", "", "clubhub");
	$connection2=mysqli_connect("localhost","root", "", "clubhub");
	$connection3=mysqli_connect("localhost","root", "", "clubhub");
	$connection4=mysqli_connect("localhost","root", "", "clubhub");
	$connection5=mysqli_connect("localhost","root", "", "clubhub");

	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>

<?php
//create query
	//query to get the clubid of the club the person is in.
	$club = $connection1->prepare("(SELECT clubID FROM person natural join member_of WHERE pid=?)
									UNION (SELECT clubID FROM person natural join advisor_of WHERE pid=?)");
	//$club->bind_param("ss", $_GET['pid'], $_GET['pid']);
	$club->bind_param("ss", $personId, $personId);
	$personId = "1";
	

	$club->bind_result($clubId);
	
	//query to get event that the person signed up
	$querySignUp = "SELECT distinct ename, edatetime, location, sponsored_by FROM sign_up natural join event WHERE pid=? and ";
	$querySignUp.= "edatetime>= curdate()";
	$signedUp = $connection2->prepare($querySignUp);
	
	//$signedUp->bind_param("s", $_GET['pid']);
	$signedUp->bind_param("s", $personId);
	$signedUp->bind_result($ename, $edatetime, $location, $sponsored_by);
	

	//query to get event for the current day and the next three day that is public.
	$queryPublicEvent = "SELECT distinct ename, edatetime, location, sponsored_by FROM event WHERE is_public_e=1 and ";
	$queryPublicEvent.= "edatetime BETWEEN curdate() and (Curdate() + interval 3 day) and ";
	$queryPublicEvent.= "(ename, edatetime, location, sponsored_by) NOT IN(" . $querySignUp . ")";
	$publicEvent = $connection3->prepare($queryPublicEvent);
	
	//$publicEvent->bind_param("s", $_GET['pid']);
	$publicEvent->bind_param("s", $personId);
	$publicEvent->bind_result($pEname, $pEdatetime, $pLocation, $pSponsored_by);
	
	
	//query to get event for the current day and the next three day that is sponsored by your club.
	$queryOtherEvent = "SELECT distinct ename, edatetime, location, sponsored_by FROM event WHERE is_public_e=0 and sponsored_by=? and ";
	$queryOtherEvent.= "edatetime BETWEEN curdate() and (Curdate() + interval 3 day) and ";
	$queryOtherEvent.= "(ename, edatetime, location, sponsored_by) NOT IN(" . $querySignUp . ")";
	$otherEvent = $connection4->prepare($queryOtherEvent);

	//$otherEvent->bind_param("is", $checkClubid, $_GET['pid']);
	$otherEvent->bind_param("is", $checkClubid, $personId);
	$otherEvent->bind_result($oEname, $oEdatetime, $oLocation, $oSponsored_by);
	
	
	//query to get sponsor name.
	$sponsor = $connection5->prepare("SELECT cname FROM club WHERE clubid=?");
	$sponsor->bind_param("s", $eventSponsor);
	$sponsor->bind_result($cname);
?>
<div>
	<h1> Events </h1>
</div>
<div>
	<h4> Event(s) you have already signed up for: </h4><hr>
</div>
<?php
	$signedUp->execute();
	//echo "Event you have already signed up for: " . "</br><hr/></br>";
	while($signedUp->fetch()){
		echo 'Event name: ' . $ename . "</br>";
		echo 'Datetime: ' . $edatetime . "</br>";
		echo 'Location: ' .  $location . "</br>";
		$eventSponsor = $sponsored_by;
		$sponsor->execute();
		if($sponsor->fetch()){
			echo 'Sponsored By: ' .  $cname . "</br><hr/>";
		}
	}
?>
<div>
	<h4> Event(s) for the current day and the next three day that you can sign up for:  </h4><hr>
</div>
<?php
	$publicEvent->execute();
	//echo "Event thats public: " . "</br><hr/></br>";
	while($publicEvent->fetch()){
		echo 'Event name: ' . $pEname . "</br>";
		echo 'Datetime: ' . $pEdatetime . "</br>";
		echo 'Location: ' .  $pLocation . "</br>";
		$eventSponsor = $pSponsored_by;
		$sponsor->execute();
		if($sponsor->fetch()){
			echo 'Sponsored By: ' .  $cname . "</br><hr/>";
		}
	}
	
	$club->execute();
	while($club->fetch()){
		$clubID=$checkClubid;
		$otherEvent->execute();
		while($otherEvent->fetch()){
			echo"hello22222";
			echo 'Event name: ' . $ename . "</br>";
			echo 'Datetime: ' . $edatetime . "</br>";
			echo 'Location: ' .  $location . "</br>";
			$eventSponsor = $oSponsored_by;
			$sponsor->execute();
			if($sponsor->fetch()){
				echo 'Sponsored By: ' .  $cname . "</br><hr/>";
			}
		}
	}
	
?>


<?php
	$club->close();
	$signedUp->close();
	$publicEvent->close();
	$otherEvent->close();
	$sponsor->close();
	mysqli_close($connection1);
	mysqli_close($connection2);
	mysqli_close($connection3);
	mysqli_close($connection4);
	mysqli_close($connection5);				
?>

 <a href="logout.php">logout</a>  <br>
