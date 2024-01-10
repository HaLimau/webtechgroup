<?PHP
	session_start();
	include('config.php');
//check if logged-in as admin
$check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);
if(!isset($_SESSION["UID"]) && $row["user_type"] != 0){
	header("location:index.php");
}
//this action is called when the Delete link is clicked
	if(isset($_GET["id"]) && $_GET["id"] != ""){
		$id = $_GET["id"];
		$query = "SELECT * FROM  books
		WHERE bookID ='" . $id . "'";
		$result = mysqli_query($conn, $query);
		
		if($result){
			$row = mysqli_fetch_assoc($result);
			$filepath = "uploads/book_covers/" . $row["cover_image"];
			
			if(!empty($row["cover_image"]) && file_exists($filepath) && $row["cover_image"] != "N"){
				unlink($filepath); //Deleting it from folder
			}
			
			$sql = "DELETE FROM books WHERE bookID=" . $id;
			echo $sql . "<br>";
			if (mysqli_query($conn, $sql)) {
				echo "Book deleted successfully<br>";
				echo '<a href="javascript:history.back()">Back</a>';
			} else {
				echo "Error deleting record: " . mysqli_error($conn) . "<br>";
				echo '<a href="books.php">Back</a>';
			}	
		}else {
			echo "Error fetching file path: " . mysqli_error($conn) . "<br>";
			echo '<a href="books.php">Back</a>';
    }
	mysqli_free_result($result);

		
}	
mysqli_close($conn);
?>