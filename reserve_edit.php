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

<body id="ntahkalikeberapasdhni">
    <div class="header">
        <h1>Library Rooms</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            // add if admin, different menu again
        }
        else {
            include 'menus/loggedout_menu.php';
        }
    ?>

    <?php 
        $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);
        $reserveOwner = "SELECT userID FROM roombookings WHERE userID=" . $_SESSION["UID"];
        $result2 = mysqli_query($conn, $reserveOwner);
        $ownerRow = mysqli_fetch_assoc($result2);


        if(isset($_GET["id"]) && $_GET["id"] != "" && ($row["user_type"] == 0 || $ownerRow["userID"] == $_SESSION["UID"])) {
            $reservationID = $_GET["id"];

            $sql = "SELECT * FROM roombookings WHERE bookingID = $reservationID";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $roomId = $row["roomID"];
            $userId = $_SESSION["UID"]; 
            $bookDate = $row["booking_date"];
            $bookTime = $row["booking_time"];
    ?>
<br>
<div id="ntahkalikeberapasdhni" align=center>
            <form method="POST" action="reserve_edit_action.php"  enctype="multipart/form-data"  id="myForm">
                <table border="1" id="editReserve">
                <tr>
                    <td>Room Name :</td>
                
                    <td>
                        <?php
                            // Populate dropdown with rooms
                            $tableDataRoom = "SELECT * FROM rooms";
                            $result = mysqli_query($conn, $tableDataRoom);
                            echo "<select name='roomID'>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $roomId = $row['roomID'];
                                $roomName = $row['roomName'];
                                echo "<option value='$roomId' " . ($selectedRoom == $roomId ? 'selected' : '') . ">$roomName</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Reserved by : </td>
                    <td>
                        <?php $userData = "SELECT * FROM user"; $userRow=mysqli_fetch_assoc(mysqli_query($conn,$userData))?>

                        <textarea name="location" class="noResize" disabled><?=$userRow["username"]?></textarea>
                        <input hidden id="userId" name="userId" value="<?=$_SESSION["UID"]?>">
                        <input hidden id="bookingID" name="bookingID" value="<?=$_GET["id"]?>">
                    </td>
                </tr>
                <tr>
                    <td>Booking Date : </td>
                    <td>
                        <input type="date" name="bookDate">
                    </td>
                </tr>
                <tr>
                    <td>Booking Time: </td>
                    <td>
                            <input type="time" name="bookTime">
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
        } else {
            header("location:index.php");
        }
    ?>

    <?php include 'footer.php';?>
</body>

</html>
