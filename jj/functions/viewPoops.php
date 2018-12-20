<?php
	session_start();

	include '../dbConnect.php';

	$conn = dbConnect();
    
    // Get all the heroes in an array
    $poops = getAllPoops();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Poops</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../src/jj.css">
</head>
<body>
	<h1 class="title">Poops</h1>
	<div class="container">
		<a class="btn btn-block btn-info" href="../index.php">Home</a>
		<!-- Deleted Message -->
        <?php
          if (isset($_SESSION['deleted'])) {
            echo "<h4 class='confirmMessage'>Deletion successful!</h4>";
            unset($_SESSION['deleted']);
          }
        ?>
        
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <!-- Commenting out the id. Uncomment when testing -->
                    <!-- <th scope="col">id</th> -->
                    <th scope="col">Time</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
              <?php
                
                foreach ($poops as $p) {
                        echo "<tr>";
                        // echo "<th scope='row'>" . $p['id'] . "</th>";
                        echo "<th scope='row'>" . prettyDateAndTime($p['time']) ."</td>";
                        echo "<td>" . $p['notes'] ."</td>";
                        echo "<td>";
                        echo "<form method='POST' action='./edit.php'>
                                <div class='form-group'>
                                <input type='hidden' name='type' value='poop'>
                                <button class='btn btn-success' type='submit' name='editBtn' value='" . $p['id'] . "'>Edit</button>";
                        echo "</form>";
                        echo "<form method='POST' action='./delete.php'>
                                <div class='form-group'>
                                <input type='hidden' name='type' value='poop'>
                                <button id='deleteBtn' class='btn btn-danger' type='submit' name='deleteBtn' value='" . $p['id'] . "'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                      }
                
              ?>
            </tbody>
      </table>
	</div>

	
	
    <!-- jQuery -->
    <script type="text/javascript" src="../../jquery/jquery-3.3.1.js"></script>
    <!-- Custom JS file -->
    <script type="text/javascript" src="../src/jj.js"></script>
</body>
</html>