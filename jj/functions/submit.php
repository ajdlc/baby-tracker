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
		if(isset($_POST['date']) && !(empty($_POST['date']))) {
			// Get the variables
			$date = $_POST['date'];
			$note = $_POST['notes'];
			$typeOfFeed = $_POST['typeOfFeed'];
			insertNewFeedWithDate($date, $note, $typeOfFeed);
			// Set the session variable
			$_SESSION['type'] = "feeding";
			// Forward the user back to the previous page
    		header("Location: http://$ip:$port/jj/index.php");
		} else {
			// If the date is not set, call a different function.
			$note = $_POST['notes'];
			$typeOfFeed = $_POST['typeOfFeed'];
			insertNewFeedWithoutDate($note, $typeOfFeed);
			// Set the session variable
			$_SESSION['type'] = "feeding";
			// Forward the user back to the previous page
    		header("Location: http://$ip:$port/jj/index.php");
		}

	} elseif($_POST['type'] == "pee") {
		// If it's a pee, determine if the date is set.
		if(isset($_POST['date']) && !(empty($_POST['date']))) {
			// Get the variables
			$date = $_POST['date'];
			$note = $_POST['notes'];
			insertNewPeeWithDate($date, $note);
			// Set the session variable
			$_SESSION['type'] = "pee";
			// Forward the user back to the previous page
    		header("Location: http://$ip:$port/jj/index.php");
		} else {
			// If the date is not set, call a different function.
			$note = $_POST['notes'];
			insertNewPeeWithoutDate($note);
			// Set the session variable
			$_SESSION['type'] = "pee";
			// Forward the user back to the previous page
    		header("Location: http://$ip:$port/jj/index.php");
		}

	} elseif($_POST['type'] == "poop") {
		// If it's a poop, determine if the date is set.
		if(isset($_POST['date']) && !(empty($_POST['date']))) {
			// Get the variables
			$date = $_POST['date'];
			$note = $_POST['notes'];
			insertNewPoopWithDate($date, $note);
			// Set the session variable
			$_SESSION['type'] = "poop";
			// Forward the user back to the previous page
    		header("Location: http://$ip:$port/jj/index.php");
		} else {
			// If the date is not set, call a different function.
			$note = $_POST['notes'];
			insertNewPoopWithoutDate($note);
			// Set the session variable
			$_SESSION['type'] = "poop";
			// Forward the user back to the previous page
    		header("Location: http://$ip:$port/jj/index.php");
		}
	} else {
		// This should never be called.
		print("It is not!");
	}
?>