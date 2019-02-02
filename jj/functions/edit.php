<?php
	session_start();

	include '../dbConnect.php';

	$conn = dbConnect();

	// Get the id of whatever we are editing
	$id = $_POST['editBtn'];

	// Get the type
	$type = $_POST['type'];

	// Determine what type of submit it is, either a poop, pee, or feed
	if($_POST['type'] == "feed") {
		// Get the correct feed entry
		$record = getFeed($id);

	} elseif($_POST['type'] == "pee") {
		// Get the correct pee entry
		$record = getPee($id);

	} elseif($_POST['type'] == "poop") {
		// Get the correct poop entry
		$record = getPoop($id);
	} else {
		// This should never be called.
		print("It is not!");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit <?= ucfirst($type); ?></title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../src/jj.css">
</head>
<body>
	<h1 class="title">Add New <?= ucfirst($type); ?></h1>
	<div class="container">
		<form method="POST" action="update.php" autocomplete="off">
			<div class="form-group">
				<label class="formLabels" for="date">Date</label>
	    		<input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD HH:MM:SS OR LEAVE BLANK FOR TODAYS DATE AND TIME" value="<?= $record['time']; ?>">
			</div>
			<?php
				if($type == 'feed') {
					echo '
							<div class="form-group">
								<label for="typeOfFeed">Type of Feed</label>
								<select class="form-control" id="typeOfFeed" name="typeOfFeed">
									<option>Breast Fed</option>
									<option selected>Formula Fed</option>
									<option>Breast and Formula Fed</option>
								</select>
							</div>';
				}
			?>
			
			<div class="form-group">
				<label class="formLabels" for="notesArea">Notes</label>
				<textarea class="form-control" id="notes" name="notes" rows="3"><?= $record['notes']; ?></textarea>
			</div>
			<input type="hidden" name="id" value="<?= $record['id']; ?>">
			<button type="submit" class="btn btn-block btn-primary" name="type" value="<?= $type; ?>">Submit</button>
		</form>	
		<a class="btn btn-block btn-success" href="../index.php">Home</a>
	</div>
	

</body>
</html>