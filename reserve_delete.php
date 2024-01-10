<?php
	session_start();
	include('config.php');
//check if logged-in as admin
$check = "SELECT * FROM roombookings JOIN user ON roombookings.userID = user.userID
        WHERE roombookings.userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);
if(!isset($_SESSION["UID"]) && ($row["user_type"] != 0 || $row["bookingID"] == $_GET["id"]) ){
	header("location:index.php");
}

//this action is called when the Delete link is clicked
	if(isset($_GET["id"]) && $_GET["id"] != ""){
		$id = $_GET["id"];

		$sql = "DELETE FROM roombookings WHERE bookingID=" . $id;
		if (mysqli_query($conn, $sql)) {
			echo "Record deleted successfully<br>";
			echo '<a href="room_reserve.php">Back</a>';
		} else {
			echo "Error deleting record: " . mysqli_error($conn) . "<br>";
			echo '<a href="room_reserve.php">Back</a>';
		}	

    
	mysqli_free_result($result);

		
}	
mysqli_close($conn);
?>