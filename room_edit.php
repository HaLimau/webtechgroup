<?php
    include 'config.php';
    session_start();

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
        <h1>Library Rooms</h1>
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


    <?php 
         $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
         $result = mysqli_query($conn, $check);
         $row = mysqli_fetch_assoc($result);
        if(isset($_GET["id"]) && $_GET["id"] != "" ){
            if($row["user_type"] == 0){
                $sql = "SELECT * FROM rooms";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $roomName = $row["roomName"];
                $location = $row["location"];;
                $cap = $row["capacity"];;
                $roomType = $row["roomType"];;

    ?>

    <div>
            <span class="closeButton" onclick="closeAddFileDiv()">(X)</span><br>
            <form method="POST" action="room_edit_action.php"  enctype="multipart/form-data"  id="myForm">
            <input type="text" id="roomID" name="roomID" value="<?=$_GET['id']?>" hidden>
                <table border="1" id="addRoomTable">
                    
                <tr>
                    <td cols="20" rows="4" name="newsTitle" maxlength="255">Room Name : </td>
                    <td>
                        <textarea name="roomName" class="noResize"><?php echo $roomName ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Location : </td>
                    <td>
                        <textarea name="location" class="noResize"><?php echo $location ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Capacity : </td>
                    <td>
                        <textarea type="nnumber" name="capacity" class="noResize"><?php echo $cap?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Room Type : </td>
                    <td>
                    <select name="roomType">
                        <option value="1" <?php echo ($roomType == 1) ? 'selected' : ''; ?>>Hall</option>
                        <option value="2" <?php echo ($roomType == 2) ? 'selected' : ''; ?>>Cubicle</option>
                        <option value="3" <?php echo ($roomType == 3) ? 'selected' : ''; ?>>Seminar</option>
                    </select>
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
        <?php }else{
            header (locaation:index.php);
        } }
        else{
            echo "Error no file was chosen<br>";
        }
        ?>

    <?php include 'footer.php';?>
</body>

</html>
