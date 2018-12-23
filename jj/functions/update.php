<?php
	session_start();

	include '../dbConnect.php';

	$conn = dbConnect();

	// Get the server IP address
	$ip = $_SERVER['SERVER_ADDR'];
	// Get the server Port
	$port = $_SERVER['SERVER_PORT'];

	// Determine what type of submit it is, either a poop, pee, or feed
	if($_POST['type'] == "feed") {
		// If it's a feed, determine if the date is set.
		$id = $_POST['id'];
		$date = $_POST['date'];
		$notes = $_POST['notes'];
		$typeOfFeed = $_POST['typeOfFeed'];
		updateFeed($id, $date, $typeOfFeed, $notes);
		// Set the session variable
		$_SESSION['update'] = "feeding";
		// Forward the user back to the previous page
    	header("Location: http://$ip:$port/jj/index.php");

	} elseif($_POST['type'] == "pee") {
		$id = $_POST['id'];
		$date = $_POST['date'];
		$notes = $_POST['notes'];
		updatePee($id, $date, $notes);
		// Set the session variable
		$_SESSION['update'] = "pee";
		// Forward the user back to the previous page
    	header("Location: http://$ip:$port/jj/index.php");

	} elseif($_POST['type'] == "poop") {
		$id = $_POST['id'];
		$date = $_POST['date'];
		$notes = $_POST['notes'];
		updatePoop($id, $date, $notes);
		// Set the session variable
		$_SESSION['update'] = "poop";
		// Forward the user back to the previous page
    	header("Location: http://$ip:$port/jj/index.php");

	} else {
		// This should never be called.
		print("It is not!");
	}
?>