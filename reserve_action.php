<?php
    session_start();
    include('config.php');

    // Check if logged-in as admin
    $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);

    if (!isset($_SESSION["UID"]) && $row["user_type"] != 0) {
        header("location:index.php");
    }

    // Variables
    $roomID = $_POST["roomID"];
    $userID = $_POST["userId"]; 
    $bookDate = $_POST["bookDate"];
    $bookTime = $_POST["bookTime"];

    // Submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "INSERT INTO roombookings (roomID, userID, booking_date, booking_time)
                VALUES ('$roomID', '$userID', '$bookDate', '$bookTime')";

        $status = insertTo_DBTable($conn, $sql);

        if ($status) {
            echo "Reservation added successfully!<br>";
            echo '<a href="room_reserve.php">Back</a>';
        } else {
            echo '<a href="room_reserve.php">Back</a>';
        }
    } else {
        echo 'There was an error adding the reservation. <br>';
        echo '<a href="javascript:history.back()">Back</a>';
    }

    // Close DB connection
    mysqli_close($conn);

    // Function to insert data into the database table
    function insertTo_DBTable($conn, $sql) {
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
            return false;
        }
    }
?>
