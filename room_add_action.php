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
//variables
	$roomName = "";
	$location = "";
	$capacity ="";
    $roomType = "";
//Submit
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $roomName = trim($_POST["roomName"]);
        $location = trim($_POST["location"]);
        $capacity = $_POST["capacity"];
        $roomType = $_POST["roomType"];



            $sql = "INSERT INTO rooms (roomName, location, capacity, roomType)
                    Values ('$roomName', '$location', '$capacity', '$roomType') ";
			$status = insertTo_DBTable($conn, $sql);
			if ($status) {
				echo "News added successfully!<br>";
				echo '<a href="rooms.php">Back</a>';
			} else {
				echo '<a href="rooms.php">Back</a>';
			}
		

}else{
    echo 'There was an error adding the room. <br>';
    echo '<a href="javascript:history.back()">Back</a>';
}
//close db connection
mysqli_close($conn);
//Function to insert data to database table
function insertTo_DBTable($conn, $sql){
if (mysqli_query($conn, $sql)) {
return true;
} else {
echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
return false;
}}
?>