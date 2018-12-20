<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Add New Poop</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../src/jj.css">
</head>
<body>
	<h1 class="title">Add New Poop</h1>
	<div class="container">
		<form method="POST" action="submit.php" autocomplete="off">
			<div class="form-group">
				<label class="formLabels" for="date">Date</label>
	    		<input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD HH:MM:SS OR LEAVE BLANK FOR TODAYS DATE AND TIME">
			</div>
			<div class="form-group">
				<label class="formLabels" for="notesArea">Notes</label>
				<textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-block btn-primary" name="type" value="poop">Submit</button>
		</form>	
		<a class="btn btn-block btn-success" href="../index.php">Home</a>
	</div>
	

</body>
</html>