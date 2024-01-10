<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $bookID = mysqli_real_escape_string($conn, $_POST['bookSelect']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $userID = $_SESSION["UID"];  // Assuming you have stored the user ID in the session

    // Insert the review into the database
    $insertReviewSQL = "INSERT INTO book_reviews (userID, bookID, rating, comment) VALUES ('$userID', '$bookID', '$rating', '$comment')";
    
    if (mysqli_query($conn, $insertReviewSQL)) {
        $_SESSION['review_saved'] = true;
        header('Location: profile.php'); // Redirect to the profile page after saving the review
        exit();
    } else {
        echo "Error: " . $insertReviewSQL . "<br>" . mysqli_error($conn);
    }
} else {
    // Handle the case where the form was not submitted via POST
    echo "Invalid request";
}
?>
