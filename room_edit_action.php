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
    $id="";
	$sem = "";
	$year = "";
	$activity ="";
	$remark = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//values for add or edit\
        
        
        $id = $_POST["roomID"];
        $roomName = trim($_POST["roomName"]);
        $location = trim($_POST["location"]);
        $cap = $_POST["capacity"];;
        $roomType = $_POST["roomType"];;


        $sql = "UPDATE rooms SET 
                roomName = '$roomName',
                location = '$location',
                capacity = '$cap',
                roomType = $roomType
                WHERE roomID = $id
        ";

        $status = update_DBTable($conn, $sql);
        if ($status) {
            echo "Form data updated successfully!<br>";
            echo '<a href="rooms.php">Back</a>';
        } else {
        echo '<a href="rooms.php">Back</a>';
        }
		
}else{
    echo 'There was an error receiving the data.<br>';
    echo '<a href"javascript:history.back()">Back</a>';
}
//close db connection
mysqli_close($conn);
//Function to insert data to database table
function update_DBTable($conn, $sql){
	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
		return false;
		}
}
?>