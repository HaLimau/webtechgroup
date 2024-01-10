<?php
session_start();
include('config.php');

// Check if logged-in as admin
$check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);
if (!isset($_SESSION["UID"])) {
    header("location:index.php");
}

// Variables
$bookID = "";
$userID = "";
$borrowDate = "";
$dueDate = "";


// This block is called when the Submit button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values for add or edit
    $bookID = $_POST["bookID"];
    $userID = $_POST["userID"];
    $borrowDate = $_POST["start_date"];
    $dueDate = $_POST["due_date"];
    $returnStts = $_POST["return_status"];



    $sql = "INSERT INTO borrows (bookID, userID, start_date, due_date, return_status)
    VALUES ('$bookID', '$userID', '$borrowDate' , '$dueDate', '$returnStts')";
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Book data saved successfully!<br>";
        echo '<a href="book_details.php?id=' . $bookID .'">Back</a>';
    } else {
        echo 'An Error occured';
        echo '<a href="book_details.php?id=' . $bookID .'">Back</a>';
        }
    
}

// Close DB connection
mysqli_close($conn);

// Function to insert data into the database table
function insertTo_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
