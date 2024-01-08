<?php
session_start();
include 'config.php';
if (!isset($_SESSION["UID"])){
    header("location:index.php");
}

$filename = "";
$uploadDate = "";
$fileSize = "";
$fileType = "";
$userID = $_SESSION["UID"];

$targetDir = "uploads/" . $userID . "/";
if (!is_dir($targetDir)){
    mkdir($targetDir, 0755, true);
}

$uploadStatus = 1;
$supportedExtensions = array(
    "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "rtf", 
    "odt", "ods", "odp", "tex", "md", "epub", "csv", "html", "htm", 
    "jpg", "jpeg", "png", "bmp"
);

if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] != "") {
    $filetemp = $_FILES["fileToUpload"];
    $fileSize = $_FILES["fileToUpload"]["size"];
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    //filename and dir for document
    $uploadFileName = $filetemp["name"];
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // filename exists
    if (file_exists($filename)) {
        echo "ERROR: FILENAME ALREADY EXISTS. PLEASE RENAME IT BEFORE UPLOADING.<br>";
        $uploadStatus = 0;
    }
    // filesize
    if ($fileSize > 2000000) {
        echo "ERROR: FILE IS TOO LARGE.<br>";
        $uploadStatus = 0;
    }
    // file format
    if (!in_array($fileType, $supportedExtensions)) {
        echo "ERROR: Unsupported file format. Please upload a printable document or an image.<br>";
        $uploadStatus = 0;
    }

    if ($uploadStatus) {
        $sql = "INSERT INTO userfile (userID, name, size, type, upload_date)
                VALUES ('$userID', '$filename', '$fileSize', '$fileType', NOW() )";
        $status = insertTo_DBTable($conn, $sql);

        if ($status) {
            $target_file = $targetDir . basename($_FILES["fileToUpload"]["name"]);

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // Image file successfully uploaded
                // Tell successful record
                echo "Form data saved successfully!<br>";
                echo '<a href="file_storage.php">Back to Files</a>';

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
        echo "Failed to upload.<br>";
        echo '<a href="javascript:history.back()">Back</a>';
    }
}else{
    echo 'Server error. Try again later';
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
