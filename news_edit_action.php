<?PHP
	session_start();
	include('config.php');
//check if logged-in
$check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);
if(!isset($_SESSION["UID"]) && $row["user_type"] != 0){
	header("location:index.php");
}
//variables
    $id = "";
	$type = "";
	$title= "";
	$content ="";
//for upload
	$target_dir = "uploads/news/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
	$target_file = "";
	$uploadOk = 0;
	$imageFileType = "";
	$uploadfileName = "";
//this block is called when button Submit is clicked
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//values for add or edit
        $id = $_POST["newsID"];
        $type = $_POST["newsType"];
        $title= trim($_POST["newsTitle"]);
        $content = trim($_POST["newsContent"]);
		$filetmp = $_FILES["fileToUpload"];
	//file of the image/photo file
		$uploadfileName = $filetmp["name"];
	//Check if there is an image to be uploaded
		//IF no image
		if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] == ""){
            $sql = "UPDATE news SET
            title='" . $title . "', 
            content = '" . $content . "', 
            newsType ='" . $type . "'
            WHERE newsID =" . $id;
    
			$status = update_DBTable($conn, $sql);
			if ($status) {
				echo "News Edited successfully!<br>";
				echo '<a href="news.php">Back</a>';
			} else {
				echo '<a href="news.php">Back</a>';
			}
		}
		//IF there is image
		else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {			

			//Variable to determine for image upload is OK
			$uploadOk = 1;
			$filetmp = $_FILES["fileToUpload"];
			
			//file of the image/photo file
			$uploadfileName = $filetmp["name"];
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
				$uploadOk = 0;
			}
			// Check file size <= 488.28KB or 500000 bytes
			if ($_FILES["fileToUpload"]["size"] > 5242880) {
				echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
				$uploadOk = 0;
			}
			// Allow only these file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
				$uploadOk = 0;	
			}
			//If uploadOk, then try add to database first 
			//uploadOK=1 if there is image to be uploaded, filename not exists, file size is ok and format ok
			if($uploadOk){
                $oldimg = "SELECT * FROM news WHERE news.newsID =" . $id;
				deleteOldImage($conn, $oldimg);
                
                $sql = "UPDATE news SET
                title='" . $title . "', 
                content = '" . $content . "', 
                newsType ='" . $type . "',
                image ='" . $uploadfileName . "'
                WHERE newsID =" . $id;
                $status = update_DBTable($conn, $sql);
					if ($status) {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						//Image file successfully uploaded
						//Tell successfull record
						echo "News data saved successfully!<br>";
						echo '<a href="news.php">Back</a>';
					}
					else{
						//There is an error while uploading image
						echo "Sorry, there was an error uploading your file.<br>";
						echo '<a href="javascript:history.back()">Back</a>';
					}
				}
				else {
					echo "Sorry, there was an error uploading your file.<br>";
					echo '<a href="javascript:history.back()">Back</a>';
				}
			}
			else{
				echo "Sorry, there was an error uploading your file.<br>";
				echo '<a href="javascript:history.back()">Back</a>';
		}
}
}
//close db connection
mysqli_close($conn);
//Function to insert data to database table
function update_DBTable($conn, $sql){
	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
		return false;
		}
}

function deleteOldImage ($conn, $oldimg){
    $result = mysqli_query($conn, $oldimg);
    $row = mysqli_fetch_assoc($result);
    if(!empty($row['image']) && file_exists("uploads/news/" . $row['image']) ){
        unlink("uploads/news/" . $row['image']);//This will work ong frrfrfrf
    }	
}
?>