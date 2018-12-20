<?php
	session_start();

	include '../dbConnect.php';

	$conn = dbConnect();

	// Get the server IP address
	$ip = $_SERVER['SERVER_ADDR'];

	// Get the id of whatever we are deleting
	$id = $_POST['deleteBtn'];

	// Determine what type of submit it is, either a poop, pee, or feed
	if($_POST['type'] == "feed") {
		// Delete the feed
		deleteFeeding($id);
		// Set the session variable
		$_SESSION['deleted'] = true;
		// Forward the user back to the previous page
    	header("Location: http://$ip:8080/jj/functions/viewFeeds.php");

	} elseif($_POST['type'] == "pee") {
		// Delete the pee
		deletePee($id);
		// Set the session variable
		$_SESSION['deleted'] = true;
		// Forward the user back to the previous page
    	header("Location: http://$ip:8080/jj/functions/viewPees.php");

	} elseif($_POST['type'] == "poop") {
		// Delete the poop
		deletePoop($id);
		// Set the session variable
		$_SESSION['deleted'] = true;
		// Forward the user back to the previous page
    	header("Location: http://$ip:8080/jj/functions/viewPoops.php");
	} else {
		// This should never be called.
		print("It is not!");
	}
?>