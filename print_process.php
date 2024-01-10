<?php
include 'config.php'; // Include database connection

if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'];
    $userID = $_POST['userID'];
    $phone = $_POST['phone'];
    $reqTime = $_POST['request_time'];
    $filename = $_FILES["fileToUpload"]["name"];

    // File handling
    $target_dir = "uploads/printFile"; // Target directory for uploaded files
    $target_file = $target_dir . "/" . $userID . '_' . basename($_FILES["fileToUpload"]["name"]);
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    // Check file type (optional)
    $allowed_types = array('pdf', 'doc', 'docx');
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, $allowed_types)) {
        die("Invalid file type. Only PDF, DOC, and DOCX files are allowed.");
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Store details in database
        $sql = "INSERT INTO print_requests (userID, file_name, name, phone, datetime_req) 
        VALUES ('$userID', '$filename' , '$name' , '$phone' , '$reqTime')";
         $status = insertTo_DBTable($conn, $sql);

        if ($status) {
            echo "Print document data and file saved successfully!<br>";
            echo '<a href="books.php">Back</a>';
        } else {
            echo '<a href="books.php">Back</a>';
        }
        
    } else {
        echo "File upload failed.";
    }
}

mysqli_close($conn); // Close database connection
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
