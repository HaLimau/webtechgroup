<?php
	session_start();
	include('config.php');
//check if logged-in
    $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
	$result = mysqli_query($conn, $check);
	$row = mysqli_fetch_assoc($result);
    if(!isset($_SESSION["UID"]) && $row["user_type"] != 0){
		header("location:index.php");
	}

    if(isset($_POST["delete_img"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "SELECT image FROM news WHERE newsID=" . $_GET["id"];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $filepath = "uploads/news/" . $row["image"];

        if(!empty($row["image"]) && file_exists($filepath)){
            unlink($filepath);
            
            $sql = "UPDATE news SET image = '' WHERE newsID=" . $_GET["id"];
            mysqli_query($conn, $sql);
            $status = insertTo_DBTable($conn, $sql);
            if($status){
                echo "News Image Deleted!<br>";
                echo '<a href="javascript:history.back()">Back to editting</a><br>';
                echo '<a href="news.php">Back to My Activities</a>';
            }else{
                echo "Sorry there was an error. Please try again later.";
                echo '<a href="javascript:history.back()">Back</a>';
            }
        }
    }else {
        echo "AAAAAAAAAAAAAa";
    }


  
mysqli_close($conn);
    function insertTo_DBTable($conn, $sql){
        if (mysqli_query($conn, $sql)) {
        return true;
        } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
        }}