<?php
	session_start();
	include('config.php');
    //check if logged-in
    $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);
    $userType = $row["user_type"];
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
        <h1>Library Book Collection</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {include 'menus/loggedout_menu.php';}
    ?>


    <p align=center>Click a Book to see if it is available to borrow</p>
    <!--  -->
    <?php
    if($userType == "0"){

    $itemsPerPage = 10; // Number of items to display per page
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

    $startFrom = ($currentPage - 1) * $itemsPerPage; 

    $sql = "SELECT * FROM books LIMIT $startFrom, $itemsPerPage";
    $result = mysqli_query($conn, $sql);

    // Fetching total records
    $totalItems = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books"));

    echo '<!--Num of records statement-->';
    echo '<p>Displaying books&nbsp;' . ($startFrom + 1) . ' to ' . min($startFrom + $itemsPerPage, $totalItems) . ' out of  ' . $totalItems . '</p>';
    echo '<!--Pagination-->';
    echo '<p>';
    ?>
    
    <table border="1" width="90%" id="roomTable">
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>ISBN</th>
				<th>Book Code</th>
				<th>Publisher</th>
				<th>Publish Date</th>
				<th>Action</th>

			</tr>
			<?php

				$numrow = $startFrom + 1;
				if (mysqli_num_rows($result) > 0){
					while ($row = mysqli_fetch_assoc($result)){
                        
                        echo '<tr>';
                            echo '<td>' . $numrow . '</td>';
                            echo '<td><a href="book_details.php?id=' . $row["bookID"] . '">' . $row["title"] . '</a></td>';
                            echo '<td>' . $row["ISBN"] . '</td>';
                            echo '<td>' . $row["book_code"] . '</td>';
                            echo '<td>' . $row["publisher"] . '</td>';
                            echo '<td>' . $row["publish_date"] . '</td>';
                            echo '<td><a href="book_edit.php?id=' . $row["bookID"] . '">Edit </a>';
                            echo '<a href="book_delete.php?id=' . $row["bookID"] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
						$numrow++;
					}
				}else {
					echo '<tr><td colspan="7">0 results</td></tr>';
					}
			?>
		</table>
                </br>
                <p style="text-align:center;"><a href="borrowing.php">Press here to see the current borrowing list</a></p>
                </br>
    <?php
     echo '  <div style="text-align:center;">';
    // Show if not first page
    if ($currentPage > 1) {
        echo '<a href="?page=1"> <img src="images/double.left.png" height="25" width="25" /></a>';
        echo '<a href="?page=' . max(1, $currentPage - 1) . '"> <img src="images/toleft.png" height="25" width="25"/></a>';
    }

    // Show if not last page
    if ($currentPage < ceil($totalItems / $itemsPerPage)) {
        echo '<a href="?page=' . min(ceil($totalItems / $itemsPerPage), $currentPage + 1) . '"> <img src="images/toright.png" height="25" width="25" /></a>';
        echo '<a href="?page=' . ceil($totalItems / $itemsPerPage) . '"> <img src="images/double.right.png" height="25" width="25"/></a>';
    }
    echo '</div>';
    echo '</p>';
    echo '<!--Pagination End-->';?>

<div class="addBtnDiv">
       <img class="icon" onclick="addFileDiv()" src="images/add_button.svg">
       <span class="addBtnTooltip">Add File</span>
    </div>

    <div id="addFileDiv">
            <span class="closeButton" onclick="closeAddFileDiv()">(X)</span><br>
            <form method="POST" action="book_add_action.php" enctype="multipart/form-data" id="myForm">
    <table border="1" id="addBookTable">

        <tr>
            <td cols="20" rows="4" name="newsTitle" maxlength="255">Title: </td>
            <td>
                <textarea name="title" class="noResize"></textarea>
            </td>
        </tr>
        <tr>
            <td>ISBN: </td>
            <td>
                <textarea name="ISBN" class="noResize"></textarea>
            </td>
        </tr>
        <tr>
            <td>Book Code: </td>
            <td>
                <textarea name="bookCode" class="noResize"></textarea>
            </td>
        </tr>
        <tr>
            <td>Author: </td>
            <td>
                <textarea name="author" class="noResize"></textarea>
            </td>
        </tr>
        <tr>
            <td>Publish Date: </td>
            <td>
                <input type="date" name="publishDate">
            </td>
        </tr>
        <tr>
            <td>Publisher: </td>
            <td>
                <textarea name="publisher" class="noResize"></textarea>
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
                <textarea name="description" class="noResize"></textarea>
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





<?php

}
else{

?>

    <?php
        $itemsPerPage = 10; // Number of items to display per page
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
    
        $startFrom = ($currentPage - 1) * $itemsPerPage; 
    
        $sql = "SELECT * FROM books LIMIT $startFrom, $itemsPerPage";
        $result = mysqli_query($conn, $sql);
    
        // Fetching total records
        $totalItems = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books"));
    
        echo '<!--Num of records statement-->';
        echo '<p>Displaying books&nbsp;' . ($startFrom + 1) . ' to ' . min($startFrom + $itemsPerPage, $totalItems) . ' out of  ' . $totalItems . '</p>';
        echo '<!--Pagination-->';
        echo '<p>';
        ?>
        
        <table border="1" width="90%" id="roomTable">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Book Code</th>
                    <th>Publisher</th>
                    <th>Publish Date</th>
    
                </tr>
                <?php
    
                    $numrow = $startFrom + 1;
                    if (mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                            
                            echo '<tr>';
                                echo '<td>' . $numrow . '</td>';
                                echo '<td><a href="book_details.php?id=' . $row["bookID"] . '">' . $row["title"] . '</a></td>';
                                echo '<td>' . $row["ISBN"] . '</td>';
                                echo '<td>' . $row["book_code"] . '</td>';
                                echo '<td>' . $row["publisher"] . '</td>';
                                echo '<td>' . $row["publish_date"] . '</td>';
                                echo '</td>';
                                echo '</tr>';
                            $numrow++;
                        }
                    }else {
                        echo '<tr><td colspan="7">0 results</td></tr>';
                        }
                ?>
            </table>
            </br>
                <p style="text-align:center;"><a href="borrowing.php">Press here to see the current borrowing list</a></p>
                </br>
                    <?php
                    echo '  <div style="text-align:center;">';
                    // Show if not first page
                    if ($currentPage > 1) {
                        echo '<a href="?page=1"> <img src="images/double.left.png" height="25" width="25" /></a>';
                        echo '<a href="?page=' . max(1, $currentPage - 1) . '"> <img src="images/toleft.png" height="25" width="25"/></a>';
                    }
                
                    // Show if not last page
                    if ($currentPage < ceil($totalItems / $itemsPerPage)) {
                        echo '<a href="?page=' . min(ceil($totalItems / $itemsPerPage), $currentPage + 1) . '"> <img src="images/toright.png" height="25" width="25" /></a>';
                        echo '<a href="?page=' . ceil($totalItems / $itemsPerPage) . '"> <img src="images/double.right.png" height="25" width="25"/></a>';
                    }
                    echo '</div>';
                    echo '</p>';
                    echo '<!--Pagination End-->';    
                }
                    ?> 

   <?php include 'footer.php';?>

</body>

</html>
