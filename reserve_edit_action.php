<?php
session_start();
include('config.php');

// Check if logged-in as admin
$check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);

if (!isset($_SESSION["UID"])) {
    echo '<script>alert("You are not logged in.");</script>';
}
if ($row["user_type"] != 0) {
    echo '<script>alert("You do not have permission to edit reservations.");</script>';
    header("location:index.php");
    exit();
}

// Variables
$id = "";
$roomId = "";
$userId = "";
$bookDate = "";
$bookTime = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values for add or edit
    $id = $_POST["bookingID"];
    $roomId = $_POST["roomID"];
    $userId = $_POST["userId"];
    $bookDate = $_POST["bookDate"];
    $bookTime = $_POST["bookTime"];

    $sql = "UPDATE roombookings SET 
                roomID = '$roomId',
                userID = '$userId',
                booking_date = '$bookDate',
                booking_time = '$bookTime'
                WHERE bookingID = $id
    ";

    $status = update_DBTable($conn, $sql);

    if ($status) {
        echo "Reservation data updated successfully!<br>";
        echo '<a href="room_reserve.php">Back</a>';
    } else {
        echo '<a href="room_reserve.php">Back</a>';
    }
} else {
    echo 'There was an error receiving the data.<br>';
    echo '<a href="javascript:history.back()">Back</a>';
}

// Close DB connection
mysqli_close($conn);

// Function to update data in the database table
function update_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
