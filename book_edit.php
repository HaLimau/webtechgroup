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

    $newssql = "SELECT * FROM books WHERE bookID=" . $_GET["id"] ;
    $result = mysqli_query($conn, $newssql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row["title"];
        $ISBN = $row["ISBN"];
        $bookCode = $row["book_code"];
        $author = $row["author"];
        $publishDate = $row["publish_date"];
        $publisher = $row["publisher"];
        $coverImage = $row["cover_image"];
        $description = $row["description"];
    }
    ?>
	<div class="row">
		<div class="col-left">
			<?php
                $newssql = "SELECT * FROM news WHERE news.newsType = 1";
                $result = mysqli_query($conn, $newssql);

				if(is_null($row["cover_image"]) || $row["cover_image"] === "" || $row["cover_image"] == "BookCoverMissing.png"){
                    echo '<img class="image" src="uploads/book_covers/' . $coverImage .  '">';
                    echo "<p><br><br><br>No Cover has been tied with this book</p>";
                   
				}else {
					echo '<img class="image" src="uploads/book_covers/' . $coverImage .  '">';
					echo '
					<form action="book_cover_delete.php?id=' . $row["bookID"] . '" method="post">
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
            <form method="POST" action="book_edit_action.php" enctype="multipart/form-data" id="myForm">
            <input type="text" id="bookID" name="bookID" value="<?=$_GET['id']?>" hidden>
    <table border="1" id="addBookTable">

        <tr>
            <td cols="20" rows="4" name="newsTitle" maxlength="255">Title: </td>
            <td>
                <textarea name="title" class="noResize"><?php echo $title?></textarea>
            </td>
        </tr>
        <tr>
            <td>ISBN: </td>
            <td>
                <textarea name="ISBN" class="noResize"><?php echo $ISBN ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Book Code: </td>
            <td>
                <textarea name="bookCode" class="noResize"><?php echo $bookCode ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Author: </td>
            <td>
                <textarea name="author" class="noResize"><?php echo $author?></textarea>
            </td>
        </tr>
        <tr>
            <td>Publish Date: </td>
            <td>
            <input type="date" name="publishDate" value="<?php echo $publishDate; ?>">
            </td>
        </tr>
        <tr>
            <td>Publisher: </td>
            <td>
                <textarea name="publisher" class="noResize"><?php echo $publisher?></textarea>
            </td>
        </tr>
        <tr>
            <td>Cover Image: </td>
            <td>
                <input type="file" name="coverImage">
            </td>
        </tr>
        <tr>
            <td>Description: </td>
            <td>
            <textarea name="description" cols="40" rows="10" class="noResize"><?php echo $description; ?></textarea>
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