<?php
	/* ***********************************************************************************
	*	Essential Functions:
	*		dbConnect() - dbConnect is used to establish the connection to the database.
	* ************************************************************************************
	*/
	function dbConnect() {
		// Create the dsn
		$dsn = "mysql:host=localhost;dbname=jj_database";
		$username = "root";
		$password = "password";

		// Create the dbConnection and then handle the exception
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "<p>You are connected to the database!</p>";
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>An error occurred while connecting to the database: $error_message </p>";
		}
		
		return $db;
	}

	/* *****************************************************************************************
	 * 
	 * Getters - Heroes
	 *
	 * *****************************************************************************************
	 */

	/*
	 *	Get all's
	 */
	function getAllPoops() {
		global $conn;
		// TODO: Construct the array of heroes to return a good array of heroes.
		$query = "SELECT * FROM poops ORDER BY time DESC";
		$statement = $conn->prepare($query);
		$statement->execute();
		$heroes = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $heroes;
	}

	function getAllPees() {
		global $conn;
		// TODO: Construct the array of heroes to return a good array of heroes.
		$query = "SELECT * FROM pees ORDER BY time DESC";
		$statement = $conn->prepare($query);
		$statement->execute();
		$pees = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $pees;
	}

	function getAllFeedings() {
		global $conn;
		// TODO: Construct the array of heroes to return a good array of heroes.
		$query = "SELECT * FROM feedings ORDER BY time DESC";
		$statement = $conn->prepare($query);
		$statement->execute();
		$heroes = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $heroes;
	}

	/*
	 *	Get specifics
	 */

	function getPoop($id) {
		global $conn;
		$poop = array();

		$query = "SELECT * FROM poops WHERE id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		// Get the results of the statement
		$p = $statement->fetch();
		$statement->closeCursor();

		$poop['id'] = $p['id'];
		$poop['time'] = $p['time'];
		$poop['notes'] = $p['notes'];

		return $poop;
	}

	function getPee($id) {
		global $conn;
		$pee = array();

		$query = "SELECT * FROM pees WHERE id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		// Get the results of the statement
		$p = $statement->fetch();
		$statement->closeCursor();

		$pee['id'] = $p['id'];
		$pee['time'] = $p['time'];
		$pee['notes'] = $p['notes'];

		return $pee;
	}

	function getFeed($id) {
		global $conn;
		$feed = array();

		$query = "SELECT * FROM feedings WHERE id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		// Get the results of the statement
		$f = $statement->fetch();
		$statement->closeCursor();

		$feed['id'] = $f['id'];
		$feed['time'] = $f['time'];
		$feed['notes'] = $f['notes'];
		$feed['type'] = $f['type'];

		return $feed;
	}

	/*
	 * ******************************************************************************************
	 *
	 * Setters (Updates)
	 *
	 * ******************************************************************************************
	 */

	function updatePee($id, $date, $notes) {
		global $conn;
		$query = "UPDATE pees SET notes = :notes, time = :d where id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':d', $date);
		$statement->bindValue(':notes', $notes);
		try {
			$statement->execute();
			echo "Pee updated successfully!";
		} catch(PDOException $e) {
			echo "<p>An error occurred while updating record: $e </p>";
		}
		$statement->closeCursor();
	}

	function updatePoop($id, $date, $notes) {
		global $conn;
		$query = "UPDATE poops SET notes = :notes, time = :d where id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':d', $date);
		$statement->bindValue(':notes', $notes);
		try {
			$statement->execute();
			echo "Poop updated successfully!";
		} catch(PDOException $e) {
			echo "<p>An error occurred while updating record: $e </p>";
		}
		$statement->closeCursor();
	}

	function updateFeed($id, $date, $type, $notes) {
		global $conn;
		$query = "UPDATE feedings SET notes = :notes, time = :d, type = :type where id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':d', $date);
		$statement->bindValue(':notes', $notes);
		$statement->bindValue(':type', $type);
		try {
			$statement->execute();
			echo "Feed updated successfully!";
		} catch(PDOException $e) {
			echo "<p>An error occurred while updating record: $e </p>";
		}
		$statement->closeCursor();
	}

	/*
	 * ******************************************************************************************
	 *
	 * CREATE (INSERT) Functions
	 *
	 * ******************************************************************************************
	 */

	function insertNewFeedWithDate($date, $notes, $type) {
		global $conn;
		$query = "INSERT INTO feedings VALUES (NULL, :date, :notes, :type)";
		$statement = $conn->prepare($query);
		$statement->bindValue(":date", $date);
		$statement->bindValue(":notes", $notes);
		$statement->bindValue(":type", $type);
		try {
			$statement->execute();
			echo "Feeding Saved Successfully";
		} catch(PDOException $e) {
			echo "<p>An error occurred while creating new record: $e </p>";
		}
		$statement->closeCursor();
	}

	function insertNewFeedWithoutDate($notes, $type) {
		global $conn;
		$query = "INSERT INTO feedings VALUES (NULL, (SELECT DATE_FORMAT(NOW(), \"%Y-%m-%d %T\")), :notes, :type)";
		$statement = $conn->prepare($query);
		$statement->bindValue(":notes", $notes);
		$statement->bindValue(":type", $type);
		try {
			$statement->execute();
			echo "Feeding Saved Successfully";
		} catch(PDOException $e) {
			echo "<p>An error occurred while creating new record: $e </p>";
		}
		$statement->closeCursor();
	}

	function insertNewPeeWithDate($date, $notes) {
		global $conn;
		$query = "INSERT INTO pees VALUES (NULL, :date, :notes)";
		$statement = $conn->prepare($query);
		$statement->bindValue(":date", $date);
		$statement->bindValue(":notes", $notes);
		try {
			$statement->execute();
			echo "Feeding Saved Successfully";
		} catch(PDOException $e) {
			echo "<p>An error occurred while creating new record: $e </p>";
		}
		$statement->closeCursor();
	}

	function insertNewPeeWithoutDate($notes) {
		global $conn;
		$query = "INSERT INTO pees VALUES (NULL, (SELECT DATE_FORMAT(NOW(), \"%Y-%m-%d %T\")), :notes)";
		$statement = $conn->prepare($query);
		$statement->bindValue(":notes", $notes);
		try {
			$statement->execute();
			echo "Feeding Saved Successfully";
		} catch(PDOException $e) {
			echo "<p>An error occurred while creating new record: $e </p>";
		}
		$statement->closeCursor();
	}

	function insertNewPoopWithDate($date, $notes) {
		global $conn;
		$query = "INSERT INTO poops VALUES (NULL, :d, :notes)";
		$statement = $conn->prepare($query);
		$statement->bindValue(":d", $date);
		$statement->bindValue(":notes", $notes);
		try {
			$statement->execute();
			echo "Poop Saved Successfully";
		} catch(PDOException $e) {
			echo "<p>An error occurred while creating new record: $e </p>";
		}
		$statement->closeCursor();
	}

	function insertNewPoopWithoutDate($notes) {
		global $conn;
		$query = "INSERT INTO poops VALUES (NULL, (SELECT DATE_FORMAT(NOW(), \"%Y-%m-%d %T\")), :notes)";
		$statement = $conn->prepare($query);
		$statement->bindValue(":notes", $notes);
		try {
			$statement->execute();
			echo "Poop Saved Successfully";
		} catch(PDOException $e) {
			echo "<p>An error occurred while creating new record: $e </p>";
		}
		$statement->closeCursor();
	}

	/*
	 * ******************************************************************************************
	 *
	 * DELETE Functions - Heroes and Tools And Weapons - All are deleted by name.
	 *
	 * ******************************************************************************************
	 */

	function deletePee($id) {
		global $conn;
		$query = "DELETE FROM pees WHERE id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(":id", $id);
		try {
			$statement->execute();
			echo "Pee deleted successfully!";
		} catch(PDOException $e) {
			echo "<p>An error occurred while deleting record: $e </p>";
		}
		$statement->closeCursor();
	}

	function deletePoop($id) {
		global $conn;
		$query = "DELETE FROM poops WHERE id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(":id", $id);
		try {
			$statement->execute();
			echo "Poop deleted successfully!";
		} catch(PDOException $e) {
			echo "<p>An error occurred while deleting record: $e </p>";
		}
		$statement->closeCursor();
	}

	function deleteFeeding($id) {
		global $conn;
		$query = "DELETE FROM feedings WHERE id = :id";
		$statement = $conn->prepare($query);
		$statement->bindValue(":id", $id);
		try {
			$statement->execute();
			echo "Feeding deleted successfully!";
		} catch(PDOException $e) {
			echo "<p>An error occurred while deleting record: $e </p>";
		}
		$statement->closeCursor();
	}

	/*
	 * ******************************************************************************************
	 *
	 * Utilities
	 *
	 * ******************************************************************************************
	 */

	function prettyDateAndTime($dateTime) {
		global $conn;
		$query = "SELECT DATE_FORMAT(:d, '%W, %M %D, %Y - %l:%i %p') AS prettyDandT";
		$statement = $conn->prepare($query);
		$statement->bindValue(":d", $dateTime);
		$statement->execute();
		// Get the results of the statement
		$d = $statement->fetch();
		$statement->closeCursor();

		// Construct the returning heroName variable
		// TODO: It may not be an array though I think it is.
		$prettyDandT = $d['prettyDandT'];

		return $prettyDandT;
	}
?>