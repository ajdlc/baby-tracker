<?php
	session_start();

	include 'dbConnect.php';

	$conn = dbConnect();
	$lastFeeding = getLastFeeding();
	$amount24 = getLast24HoursFeedingsAmount();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>JJ's Website</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./src/jj.css">
</head>
<body>
	<!-- Title -->
	<div class="container">
		<h1 class="title">JJ's Website</h1>
		<?php
			// Check to see if a new pee, poop, or feed was created.
			if(isset($_SESSION['type']) && $_SESSION['type'] == 'feeding') {
				echo "<h2 class='confirmMessage'>Feeding was saved!</h2>";
				// Unset the variable
				unset($_SESSION['type']);
			} elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'pee') {
				echo "<h2 class='confirmMessage'>Pee was saved!</h2>";
				// Unset the variable
				unset($_SESSION['type']);
			} elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'poop') {
				echo "<h2 class='confirmMessage'>Poop was saved!</h2>";
				// Unset the variable
				unset($_SESSION['type']);
			}

			// Check to see if a pee, poop, or feed was edited.
			if(isset($_SESSION['update']) && $_SESSION['update'] == "feeding") {
				echo "<h2 class='confirmMessage'>Feeding was updated!</h2>";
				// Unset the variable
				unset($_SESSION['update']);
			} elseif (isset($_SESSION['update']) && $_SESSION['update'] == "pee") {
				echo "<h2 class='confirmMessage'>Pee was updated!</h2>";
				// Unset the variable
				unset($_SESSION['update']);
			} elseif (isset($_SESSION['update']) && $_SESSION['update'] == "poop") {
				echo "<h2 class='confirmMessage'>Poop was updated!</h2>";
				// Unset the variable
				unset($_SESSION['update']);
			}
		?>
	</div>

	<!-- Buttons -->
	<div class="container">
		<div class="row btnRow">
			<div class="col-sm">
				<a class="btn btn-block btn-outline-success homePageBtn" role="button" href="./functions/addPee.php">Add Pee</a>
			</div>
			<div class="col-sm">
				<a class="btn btn-block btn-outline-success homePageBtn" role="button" href="./functions/addPoop.php">Add Poop</a>
			</div>
			<div class="col-sm">
				<a class="btn btn-block btn-outline-success homePageBtn" role="button" href="./functions/addFeeding.php">Add Feeding</a>
			</div>
		</div>
		<div class="grid-container">
			<div class="grid-item" id="lastFeeding">
				<h2>Last Feeding</h2>
				<h3><?= prettyDateAndTime($lastFeeding['time']); ?></h3>
				<h3 class="amount">Amount/Notes:<br><?= $lastFeeding['notes']; ?></h3>
			</div>
			<div class="grid-item" id="last24Hours">
				<h2>Amount In Last 24 Hours</h2>
				<h3 id="amount"><?= $amount24; ?> oz</h3>
			</div>
		</div>
		<div class="row btnRow">
			<div class="col-sm">
				<a class="btn btn-block btn-primary homePageBtn" role="button" href="./functions/viewPees.php">Pees</a>
			</div>
			<div class="col-sm">
				<a class="btn btn-block btn-primary homePageBtn" role="button" href="./functions/viewPoops.php">Poops</a>
			</div>
			<div class="col-sm">
				<a class="btn btn-block btn-primary homePageBtn" role="button" href="./functions/viewFeeds.php">Feedings</a>
			</div>
		</div>
	</div>




	<!-- jQuery -->
	<script type="text/javascript" src="../jquery/jquery-3.3.1.js"></script>
	<!-- Custom JS file -->
	<script type="text/javascript" src="./src/jj.js"></script>
</body>
</html>