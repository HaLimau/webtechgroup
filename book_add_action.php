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
$title = "";
$ISBN = "";
$bookCode = "";
$author = "";
$publishDate = "";
$publisher = "";
$coverImage = "";
$description = "";

// For upload
$target_dir = "uploads/book_covers/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
// This block is called when the Submit button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values for add or edit
    $title = $_POST["title"];
    $ISBN = $_POST["ISBN"];
    $bookCode = $_POST["bookCode"];
    $author = $_POST["author"];
    $publishDate = $_POST["publishDate"];
    $publisher = $_POST["publisher"];
    $description = $_POST["description"];

    // File of the image/photo file
    $coverImage = $_FILES["coverImage"]["name"];

    // Check if there is an image to be uploaded
    // If no image
    if (isset($_FILES["coverImage"]) && $_FILES["coverImage"]["name"] == "") {
        $coverImage = "BookCoverMissing.png";
        $sql = "INSERT INTO books (title, ISBN, book_code, author, publish_date, publisher, cover_image, description)
        VALUES ('$title', '$ISBN', '$bookCode', '$author', '$publishDate', '$publisher', '$coverImage', '$description')";
        $status = insertTo_DBTable($conn, $sql);

        if ($status) {
            echo "Book data saved successfully!<br>";
            echo '<a href="books.php">Back</a>';
        } else {
            echo '<a href="books.php">Back</a>';
        }
    } else if (isset($_FILES["coverImage"]) && $_FILES["coverImage"]["error"] == UPLOAD_ERR_OK) {
        // Variable to determine if image upload is OK
        $uploadOk = 1;
        $target_file = $target_dir . basename($_FILES["coverImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size <= 500KB or 500000 bytes
        if ($_FILES["coverImage"]["size"] > 500000) {
            echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
            $uploadOk = 0;
        }
        // Allow only these file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // If uploadOk, then try add to database first 
        // UploadOK=1 if there is an image to be uploaded, file name not exists, file size is ok and format is ok
        if ($uploadOk) {
            $sql = "INSERT INTO books (title, ISBN, book_code, author, publish_date, publisher, cover_image, description)
            VALUES ('$title', '$ISBN', '$bookCode', '$author', '$publishDate', '$publisher', '$coverImage', '$description')";
            $status = insertTo_DBTable($conn, $sql);

            if ($status) {
                if (move_uploaded_file($_FILES["coverImage"]["tmp_name"], $target_file)) {
                    // Image file successfully uploaded
                    // Tell successful record
                    echo "Book data saved successfully!<br>";
                    echo '<a href="books.php">Back</a>';
                } else {
                    // There is an error while uploading image
                    echo "Sorry, there was an error uploading your file.<br>";
                    echo '<a href="javascript:history.back()">Back</a>';
                }
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
                echo '<a href="javascript:history.back()">Back</a>';
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
            echo '<a href="javascript:history.back()">Back</a>';
        }
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
