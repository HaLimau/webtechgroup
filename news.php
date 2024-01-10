<?php
    include 'config.php';
    session_start();
    if(isset($_SESSION["UID"])){
        $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);
        $userType = $row["user_type"];
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
    ?>

<div class="row">

<div class="col-news">
<h2>Announcements</h2>
    <div id="newsPageAnn">
        
        <table id="newsTable">
        <?php
            $newssql = "SELECT * FROM news WHERE news.newsType = 1";
            $result = mysqli_query($conn, $newssql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td style="width:80%;">';
                    echo '<div style="float: left;">' . $row['title'] . '</div>';
                    echo '<div style="float: right;">Published: ' . $row["date_published"] . '</div>';
                    echo '</td></tr>';
                    echo '<tr><td>' . $row['content'] . '<br>';
                    if (!empty($row["image"])) {
                        echo '<img id="newsImg" src="uploads/news/' . $row["image"] . '">';
                    }
                    echo '<td><a href="news_edit.php?id=' . $row['newsID'] . '">Edit</a> | ';
                    echo '<a href="news_delete.php?id=' . $row['newsID'] . '" onclick="return confirm(\'Are you sure you want to delete this news?\');">Delete</a></td></tr>';
                }
            } else {
                echo '<tr><td colspan="3">0 results</td></tr>';
            }
        ?>

        </table>
    </div>
    <h2>News</h2>
    <div id="newsPageNews">

        <table id="newsTable">
        <?php
            $newssql = "SELECT * FROM news WHERE news.newsType = 2";
            $result = mysqli_query($conn, $newssql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td style="width:80%;">';
                    echo '<div style="float: left;">' . $row['title'] . '</div>';
                    echo '<div style="float: right;">Published: ' . $row["publish_date"] . '</div>';
                    echo '<tr><td>' . $row['content'] . '<br>';
                    if (!empty($row["news_img_path"])) {
                        echo '<img id="newsImg" src="uploads/news/' . $row["news_img_path"] . '">';
                    }
                    echo '<td><a href="edit_news.php?id=' . $row["newsID"] . '">Edit</a> | ';
                    echo '<a href="javascript:void(0);" onclick="showConfirmationNews(' . $row["newsID"] . ');">Delete</a></td></tr>';
                }
            } else {
                echo '<tr><td colspan="3">0 results</td></tr>';
            }
        ?>

        </table>
    </div>
</div>
</div>
<?php if($userType == 0){?>
<div id="addNewsDiv" >
<h4 align="center">Add Announcements or News</h4>
<p align="center">Required field with mark*</p>
<form method="POST" action="newsAdd_action.php" enctype="multipart/form-data" id="myForm">
    <table border="1" id="myTable">
    <tr>
        <td>News Type*</td>
        <td width="1px">:</td>
        <td>
            <select size="1" id="newsType" name="newsType" required>
                <option value="1">Announcement</option>;
                <option value="2">News</option>;
            </select> </td>
    </tr>
    <tr>
        <td>Title</td>
        <td>:</td>
        <td>
            <textarea cols="20" rows="4" name="newsTitle" maxlength="255"></textarea>
        </td>
    </tr>
    <tr>
        <td width >Announcemnt / News content*</td>
        <td>:</td>
        <td>
            <textarea rows="10" name="newsContent" cols="40" required></textarea>
        </td>
    </tr>
    <tr>
        <td>Upload photo</td>
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
<?php } ?>
   <?php include 'footer.php';?>

</body>

</html>
