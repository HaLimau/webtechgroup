<?php
	session_start();
	include('config.php');
//check if logged-in
$check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);
if(!isset($_SESSION["UID"]) && $row["user_type"] != 0){
	header("location:books.php");
}
	
	// Variables
	$id = $_POST["bookID"];
	$title = $_POST["title"];
	$ISBN = $_POST["ISBN"];
	$bookCode = $_POST["bookCode"];
	$author = $_POST["author"];
	$publishDate = $_POST["publishDate"];
	$publisher = $_POST["publisher"];
	$description = $_POST["description"];
	
	// For upload
	$target_dir = "uploads/book_cover/";
	
	if (!is_dir($target_dir)) {
		mkdir($target_dir, 0755, true);
	}
	
	$target_file = "";
	$uploadOk = 0;
	$imageFileType = "";
	$coverImage = "";
	
	// This block is called when the button Submit is clicked
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		// Check if there is an image to be uploaded
		if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
			
			// Variable to determine if image upload is OK
			$uploadOk = 1;
			$filetmp = $_FILES["fileToUpload"];
			
			// File of the image/photo file
			$uploadfileName = $filetmp["name"];
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
				$uploadOk = 0;
			}
			
			// Check file size <= 5MB or 5242880 bytes
			if ($_FILES["fileToUpload"]["size"] > 5242880) {
				echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
				$uploadOk = 0;
			}
			
			// Allow only these file formats
			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
				$uploadOk = 0;
			}
			
			// If uploadOk, then try to add to the database first
			// uploadOK=1 if there is an image to be uploaded, filename not exists, file size is ok, and format ok
			if ($uploadOk) {
				$oldimg = "SELECT * FROM books WHERE bookID =" . $id;
				deleteOldImage($conn, $oldimg);
				
				$coverImage = $id . "_Cover." . $imageFileType;
				
				$sql = "UPDATE books SET
						title = '$title',
						ISBN = '$ISBN',
						book_code = '$bookCode',
						author = '$author',
						publish_date = '$publishDate',
						publisher = '$publisher',
						description = '$description',
						cover_image = '$coverImage'
						WHERE bookID =" . $id;
				
				$status = update_DBTable($conn, $sql);
				
				if ($status) {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $coverImage)) {
						// Image file successfully uploaded
						// Tell successful record
						echo "Book edit saved successfully!<br>";
						echo '<a href="books.php">Back</a>';
					} else {
						// There is an error while uploading the image
						echo "Sorry, there was an error uploading your file.<br>";
						echo '<a href="javascript:history.back()">Back</a>';
					}
				} else {
					echo "Sorry, there was an error updating your book.<br>";
					echo '<a href="javascript:history.back()">Back</a>';
				}
			} else {
				echo "Sorry, there was an error uploading your file.<br>";
				echo '<a href="javascript:history.back()">Back</a>';
			}
		} else {
			// If no image
			$sql = "UPDATE books SET
					title = '$title',
					ISBN = '$ISBN',
					book_code = '$bookCode',
					author = '$author',
					publish_date = '$publishDate',
					publisher = '$publisher',
					description = '$description'
					WHERE bookID =" . $id;
			
			$status = update_DBTable($conn, $sql);
			
			if ($status) {
				echo "Book Edited successfully!<br>";
				echo '<a href="books.php">Back</a>';
			} else {
				echo "Sorry, there was an error updating your book.<br>";
				echo '<a href="javascript:history.back()">Back</a>';
			}
		}
	}
	
	// Close db connection
	mysqli_close($conn);
	
	// Function to insert data to the database table
	function update_DBTable($conn, $sql) {
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
			return false;
		}
	}
	
	function deleteOldImage($conn, $oldimg) {
		$result = mysqli_query($conn, $oldimg);
		$row = mysqli_fetch_assoc($result);
		
		if (!empty($row['cover_image']) && file_exists("uploads/book_cover/" . $row['cover_image'])) {
			unlink("uploads/book_cover/" . $row['cover_image']);
		}
	}
?>
