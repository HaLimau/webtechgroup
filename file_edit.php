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

    <div id="floatFile">
        <?php   
            $fileID = $_GET["id"];
            $sql = "SELECT * FROM userfile WHERE userID = " . $_SESSION["UID"] . " AND fileID = '$fileID'";
                
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
        ?>
        <table border="1px solid" class="flTable">
            <tr>
                <td rowspan="5" style="width: 40%;">File Icon Here</td>
                <td id="floatFileName">
                    <textarea><?php echo $row["name"] ?></textarea>
                </td>
            </tr>
            <tr>
                <td id="floatFileSize"><?php echo $row["size"] ?></td>
            </tr>
            <tr>
                <td id="floatFileType"><?php echo $row["type"] ?></td>
            </tr>
            <tr>
                <td id="floatFileDate"><?php echo $row["upload_date"] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;"><button>meow</button></td>
            </tr>
            
        </table>
    </div>

   <?php include 'footer.php';?>

</body>

</html>
