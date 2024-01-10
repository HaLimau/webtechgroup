<?php
    include('config.php');
    session_start();

    $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);
    if(!isset($_SESSION["UID"])){
        header("location:profile.php");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reviewID = $_POST['reviewID'];
        $rating = $_POST['rating'];
        $comment = trim($_POST['comment']);

        $updateReviewSQL = "UPDATE book_reviews SET 
                            rating = '$rating', 
                            comment = '$comment' 
                            WHERE review_id = '$reviewID'";
        
        if (mysqli_query($conn, $updateReviewSQL)) {
            echo "Review edit saved successfully!<br>";
            echo '<a href="profile.php">Back</a>';
        } else {
            echo "Sorry, there was an error updating review.<br>";
            echo '<a href="javascript:history.back()">Back</a>';
            echo '<a href="profile.php">Return to profile</a>';
        }
    }else{
        echo "Nothing was done.";
        echo '<a href="javascript:history.back()">Back</a>';
    }
?>
