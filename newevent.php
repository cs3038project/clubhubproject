<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "clubhub");
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
	$eventid = $_POST['eventname'];
	$clubname = $_POST['clubname'];
	$query1 = 'INSERT INTO sponsored_by (`clubid`, `eid`) VALUES  (?,?)';

	if(!($stmt = $mysqli->prepare("INSERT INTO sponsored_by (`clubid`, `eid`) VALUES  (?,?)"))){
	      	 echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
		    }
		    if(!$stmt->bind_param('ss', $clubname, $eventid)){
			echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
		    }
		    if(!$stmt->execute()){
		     echo "Execute failed: (" . $stmt->errno .")" . $stmt->error;
		    }
	   
	   /* Store the result (to get properties) */
	   //$stmt->store_result()
	   $stmt->free_result();

	   /* close statement */
	   $stmt->close();
	
?>


<?php

	echo $_POST['ename'] . "</br>";
	echo $_POST['descr'] . "</br>";
	echo $_POST['edatetime'] . "</br>";
	echo $_POST['location'] . "</br>";
	echo $_POST['e_is_public'] . "</br>";
	echo $_POST['cname'] . "</br>";
?>




<?php
	mysqli_close($connection);
?>
