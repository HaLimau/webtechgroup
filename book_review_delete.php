<?php
	session_start();
	include('config.php');

	// Check if logged-in as admin or owner of the review
	$check = "SELECT * FROM book_reviews JOIN user ON book_reviews.userID = user.userID
	          WHERE book_reviews.userID = " . $_SESSION["UID"] . " OR user.user_type = 0";
	$result = mysqli_query($conn, $check);
	$row = mysqli_fetch_assoc($result);

	if (!isset($_SESSION["UID"]) || empty($row) || $_GET["id"] == "") {
		header("location:index.php");
	}

	// Check if the user is the owner of the review or is an admin
	$checkReviewOwner = "SELECT * FROM book_reviews WHERE review_id =" . $_GET["id"];
	$reviewResult = mysqli_query($conn, $checkReviewOwner);
	$reviewRow = mysqli_fetch_assoc($reviewResult);

	if ($_SESSION["UID"] != $reviewRow["userID"] && $row["user_type"] != 0) {
		echo 'Current logged user does not have access to delete this review!<br>';
		echo '<a href="javascript:history.back()">Back</a>';
		exit();
	}
	$id = $_GET["id"];
	$sql = "DELETE FROM book_reviews WHERE review_id=" . $id;

	if (mysqli_query($conn, $sql)) {
		echo "Review deleted successfully<br>";
		echo '<a href="profile.php">Back</a>';
	} else {
		echo "Error deleting review: " . mysqli_error($conn) . "<br>";
		echo '<a href="profile.php">Back</a>';
	}

	mysqli_free_result($result);
	mysqli_close($conn);
?>
