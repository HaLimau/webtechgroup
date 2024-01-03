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
                    echo '<td>Edit</td>';
                    echo '</tr>';
                }
            }else{
                echo '<tr><td>No files uploaded yet</td></tr>';
            }
        ?>


        </table>
    </div>


   <?php include 'footer.php';?>

</body>

</html>
