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
		$query = "SELECT * FROM  news 
		WHERE newsID ='" . $id . "'";
		$result = mysqli_query($conn, $query);
		
		if($result){
			$row = mysqli_fetch_assoc($result);
			$filepath = "uploads/news/" . $row["image"];
			
			if(!empty($row["image"]) && file_exists($filepath)){
				unlink($filepath); //Deleting it from folder
			}
			
			$sql = "DELETE FROM news WHERE newsID=" . $id;
			echo $sql . "<br>";
			if (mysqli_query($conn, $sql)) {
				echo "Record deleted successfully<br>";
				echo '<a href="news.php">Back</a>';
			} else {
				echo "Error deleting record: " . mysqli_error($conn) . "<br>";
				echo '<a href="news.php">Back</a>';
			}	
		}else {
			echo "Error fetching file path: " . mysqli_error($conn) . "<br>";
			echo '<a href="news.php">Back</a>';
    }
	mysqli_free_result($result);

		
}	
mysqli_close($conn);
?>