<?php
    session_start();
    include ("config.php");
    //using this to test if it properly fucking connects
    if (isset($_SESSION["UID"])){
        $sql = "SELECT * FROM user WHERE userId=" . $_SESSION["UID"] . " LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $aaaa = $row["userID"];        

    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php';?>
    <script src="scripts/scripts.js" defer></script>
    <title>Printing Service - File Inventory</title>
</head>

<body>
    <div class="header">
        <h1>File Inventory</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {include 'menus/loggedout_menu.php';}
    ?>

        <div style="padding: 0 5px;" id="searchDiv">
            <h3 align="center">File Inventory</h3>
            <!-- Search form for file name -->
            <form action="print_storage.php" method="GET" align="center">
                <label for="searchFileName">Search by File Name:</label>
                <input type="text" name="searchFileName" id="searchFileName">
                <input type="submit" value="Search">
            </form>
        </div>

    <div id="fileStorageDiv">
        <table id="fileTable">
            <tr>
            <th width="50%">Name</th>
            <th width="10%">Size</th>
            <th width="10%">Type</th>
            <th width="20%">Upload Date</th>
            <th width="10%"> <!-- Actions Header Hidden bcs why not --> </th>
            </tr>
        <?php 
            $sql = "SELECT * FROM userfile WHERE userID = " . $_SESSION["UID"];
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<tr>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . $row["size"] . '</td>';
                    echo '<td>' . $row["type"] . '</td>';
                    echo '<td>' . $row["upload_date"] . '</td>';
                    echo '<td><a href="file_edit.php?id=' . $row["fileID"] . '">Edit </a>';
                    echo '<a href="file_delete.php?id=' . $row["fileID"] . '">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }else{
                echo '<tr><td>No files uploaded yet</td></tr>';
            }
        ?>


        </table>
    </div>
             <!-- Upload button inside this page -->
    <div class="addBtnDiv">
       <img class="icon" onclick="addFileDiv()" src="images/add_button.svg">
       <span class="addBtnTooltip">Add File</span>
    </div>

    <div id="addFileDiv">
            <span class="closeButton" onclick="closeAddFileDiv()">(X)</span><br>
            <form method="POST" action="file_upload_action.php"  enctype="multipart/form-data"  id="myForm">
                <table border="1" id="uploadTable">
                    
                <tr>
                    <label for="images" class="drop-container" id="dropcontainer">
                        <input type="file" id="file" required name="fileToUpload">
                    </label>
                </tr>
                <tr>
                    <td>
                            <input type="submit" value="Upload" name="B1">                
                            <input type="reset" value="Reset" name="B2">
                    </td>
                </tr>
                

                </table>
            </form>
    </div>




   <?php include 'footer.php';?>

</body>

</html>
