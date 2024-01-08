<?php 
    session_start();
    include 'config.php';

    if(isset($_GET['id']) && $_GET["id"] != ""){
        $id = $_GET["id"];

        $query = "SELECT * FROM userfile WHERE userID =" . $_SESSION["UID"];
        $result = mysqli_query($conn, $query);

        if($result){
            $row = mysqli_fetch_assoc($result);
            $filepath = "uploads/" . $row["userID"] . "/" . $row["name"];

            if(!empty($row["name"]) && file_exists($filepath)){
                unlink($filepath);
            }

            $sql = "DELETE FROM userfile WHERE fileID = '$id' AND userID=";
            if(mysqli_query($conn, $sql)){
                echo 'File deleted successfully!<br>';
                echo '<a href="file_storage.php">Back</a>';
            }else{
                echo "Error deleting record: " . mysqli_error($conn) . "<br>";
				echo '<a href="file_storage.php">Back</a>';
            }
        }else{
            echo 'File not found<br>';
            echo '<a href="file_storage.php">Back</a>';
        }
    }

?>