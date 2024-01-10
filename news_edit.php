<?PHP
	session_start();
	include('config.php');
//check if logged-in as admin
$check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);
if(!isset($_SESSION["UID"]) && $row["user_type"] != 0){
	header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
        <?php include 'head.php';?>
        <script src="scripts/scripts.js" defer></script>
        <title>University Library</title>
	</head>
<body>
    <div class="header">
        <h1>Library News</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {include 'menus/loggedout_menu.php';}

    $newssql = "SELECT * FROM news WHERE newsID =" . $_GET["id"] ;
    $result = mysqli_query($conn, $newssql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row["image"];
        $title = $row["title"];
        $content = $row["content"];
        $type = $row["newsType"];
    }
    ?>
	<div class="row">
		<div class="col-left">
			<?php
                $newssql = "SELECT * FROM news WHERE news.newsType = 1";
                $result = mysqli_query($conn, $newssql);

				if(is_null($row["image"]) || $row["image"] === ""){
					echo "<p><br><br><br><br><br><br><br>No image associated witht this news / announcement </p>";
				}else {
					echo '<img class="image" src="uploads/news/' . $image .  '">';
					echo '
					<form action="news_image_delete.php?id=' . $row["newsID"] . '" method="post">
						Remove News Image :
						<input type="hidden" name="delete_img" value="1">
						<button type="submit">REMOVE</button>
					</form>
					';
				}
			?>
			<br><br><br>
			

			
		</div>
    <div class="col-right" >
		<h4 align="center">Edit Announcements or News</h4>
		<p align="center">Required field with mark*</p>
		<form method="POST" action="news_edit_action.php" enctype="multipart/form-data" id="myForm">
            <input type="text" id="newsID" name="newsID" value="<?=$_GET['id']?>" hidden>
			<table border="1" id="myTable">
			<tr>
				<td>News Type*</td>
				<td width="1px">:</td>
				<td>
					<select size="1" id="newsType" name="newsType" required>
                        <?php
                            if($type == "1")
                                echo '<option value="1" selected>Announcement</option>';
                            else
                                echo '<option value="1">Announcement</option>';
                            if($type == "2")
                                echo '<option value="2" selected>News</option>';
                            else 
                                echo '<option value="2">News</option>'
                        ?>
					</select> </td>
			</tr>
            <tr>
                <td>Title</td>
                <td>:</td>
                <td>
                    <textarea cols="20" rows="4" name="newsTitle" maxlength="255"><?php echo $title;?></textarea>
                </td>
            </tr>
			<tr>
				<td width >Announcemnt / News content*</td>
				<td>:</td>
				<td>
					<textarea rows="10" name="newsContent" cols="40" required><?php echo $content;?></textarea>
				</td>
			</tr>
			<tr>
				<td>Upload or Change Image</td>
				<td>:</td>
				<td>
				Max size: 5MB<br>
				<input type="file" name="fileToUpload" id="fileToUpload"
				accept=".jpg, .jpeg, .png">
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right">
					<input type="submit" value="Submit" name="B1">
					<input type="reset" value="Reset" name="B2">
				</td>
			</tr>
		</table>
		</form>
		
	</div>

            </div>
    <footer>
        <?php include 'footer.php' ?>
    </footer>

</body>
</html>