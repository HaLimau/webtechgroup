<?php
    include('config.php');
    session_start();
    $formSubmitted = false;
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data
        $selectedBookID = isset($_GET['id']) ? $_GET['id'] : null;
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $userID = $_SESSION["UID"];

        // Validate and sanitize user input before saving to the database
        // (Make sure to implement proper validation/sanitization)

        $saveReviewSQL = "INSERT INTO book_reviews (userID, bookID , rating, comment) VALUES ('$userID','$selectedBookID', '$rating', '$comment')";
        mysqli_query($conn, $saveReviewSQL);

        // Set a session variable to indicate that the review has been saved
        $_SESSION['review_saved'] = true;
        $formSubmitted = true;
        // Redirect to the same page to avoid form resubmission on page refresh
        header("Location: book_review.php?id=$selectedBookID");
        exit();
    }

    $selectedBookID = isset($_GET['id']) ? $_GET['id'] : null;
    $bookTitle = null;

    // Get the book title from the URL parameter
    if ($selectedBookID) {
        $bookSQL = "SELECT title FROM books WHERE bookID = $selectedBookID";
        $bookResult = mysqli_query($conn, $bookSQL);

        if ($bookResult) {
            $bookRow = mysqli_fetch_assoc($bookResult);
            $bookTitle = $bookRow['title'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <?php include 'head.php';?>
        <script src="scripts/scripts.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>University Library</title>
</head>
<body>

    <div class="header">
        <h1>Library Book Review</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {include 'menus/loggedout_menu.php';}
    ?>
    
    <div id="reviewsSection" class="profile-section">
    <h2>Book Reviews for <?php echo $bookTitle; ?></h2>

    <!-- Form for submitting book reviews -->
    <form action="book_review.php?id=<?php echo $selectedBookID; ?>" method="post">
        <label>Rating:</label>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo '<input type="radio" name="rating" value="' . $i . '">' . $i;
        }
        ?>

        <br>

        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" rows="4" cols="50"></textarea>

        <br>

        <input type="submit" value="Submit Review">
    </form>

    <?php
    // Display popup message if review is saved
    if (isset($_SESSION['review_saved'])) {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Your review has been saved!"
                        });
                      </script>';
    }
    ?>
</div>

<footer>
    <?php include 'footer.php'; ?>
</footer>

</body>
</html>
