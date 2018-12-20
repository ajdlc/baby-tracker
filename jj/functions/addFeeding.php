<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Add New Feeding</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../src/jj.css">
</head>
<body>
	<h1 class="title">Add New Feeding</h1>
	<div class="container">
		<form method="POST" action="submit.php" autocomplete="off">
			<div class="form-group">
				<label class="formLabels" for="date">Date</label>
	    		<input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD HH:MM:SS OR LEAVE BLANK FOR TODAYS DATE AND TIME">
			</div>
			<div class="form-group">
				<label for="typeOfFeed">Type of Feed</label>
				<select class="form-control" id="typeOfFeed" name="typeOfFeed">
					<option>Breast Fed</option>
					<option selected>Formula Fed</option>
					<option>Breast and Formula Fed</option>
				</select>
			</div>
			<div class="form-group">
				<label class="formLabels" for="notesArea">Notes</label>
				<textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-block btn-primary" name="type" value="feed">Submit</button>
		</form>	
		<a class="btn btn-block btn-success" href="../index.php">Home</a>
	</div>
	

</body>
</html>