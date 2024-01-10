<?php
    include 'config.php';
    session_start();
    if (isset($_GET["id"]) && $_GET["id"] != ""){
        $checkRevOwner= "SELECT book_reviews.*, books.title AS title
        FROM book_reviews
        JOIN books ON book_reviews.bookID = books.bookID
        WHERE review_id =" . $_GET["id"];
        $checkRow = mysqli_fetch_assoc(mysqli_query($conn, $checkRevOwner));
        $chkUserType = "SELECT * FROM user WHERE userID = " .$_SESSION["UID"];
        $checkUser = mysqli_fetch_assoc(mysqli_query($conn, $chkUserType));
        if($_SESSION["UID"] != $checkRow["userID"] && $checkUser != 0){
            echo 'Current logged user does not have access to edit this review!';
            echo "<br> <a href='javascript:history.back()'>Back</a>";
        }
        $userID = $checkRow["userID"];
        $bookID = $checkRow["bookID"];
        $rating = $checkRow["rating"];
        $comment= $checkRow["comment"];
        $timestamp = $checkRow ["timestamp"];
        $title = $checkRow["title"];
        $reviewID = $checkRow["review_id"];



    }else{
        echo "Error, no review selected";
        echo "<br> <a href='javascript:history.back()'>Back</a>";
    }
    
    

?>
<!DOCTYPE html>
<html>  

<head>
    <?php include 'head.php';?>
    <script src="scripts/scripts.js" defer></script>
    <title>University Library</title>
</head>

<body style="min-height:120vh; ">
    <div class="header">
        <h1>Review Edit</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
//add if admin, different menu again
        }
        else {
            include 'menus/loggedout_menu.php';
        }
    ?>
    <div id="biggerDiv">
            <form method="POST" action="book_review_edit_action.php"  enctype="multipart/form-data"  id="myForm">
            <input type="text" id="reviewID" name="reviewID" value="<?=$reviewID?>" hidden>
                <table border="1" id="revEditTable">
                <tr>
                    <td cols="20" rows="4" name="newsTitle" maxlength="255">Book Title: </td>
                    <td style="text-align:center;">
                        <textarea name="title" class="noResize" disabled><?=$title?></textarea>
                    </td>
                </tr>
                <tr>
                    <td cols="20" rows="4" name="newsTitle" maxlength="255">Rating : </td>
                    <td>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $checked = ($i == $rating) ? 'checked' : ''; // Check if the current iteration value matches the stored rating
                            echo '<input type="radio" name="rating" value="' . $i . '" ' . $checked . '>' . $i;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Comment : </td>
                    <td style="text-align:center;">
                        <textarea style="height:400px" cols='20' name="comment" class="noResize"><?=$comment?></textarea>
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

    <?php include 'footer.php';?>
</body>

</html>
