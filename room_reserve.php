<?php
    include 'config.php';
    session_start();

    $selectedRoom = isset($_GET['room']) ? $_GET['room'] : '';


    $sqlRooms = "SELECT * FROM rooms";
    $resultRooms = mysqli_query($conn, $sqlRooms);

    $sqlReservations = "SELECT * FROM roombookings JOIN rooms ON roombookings.roomID = rooms.roomID LEFT JOIN user ON roombookings.userID = user.userID";
    if (!empty($selectedRoom)) {
        $sqlReservations .= " WHERE roombookings.roomID = $selectedRoom";
    }
    $resultReservations = mysqli_query($conn, $sqlReservations);
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
    <br>
        <div style="padding:0 10px; ">
        <form method="get" action="">
            <label for="room">Select a Room:</label>
            <select name="room" id="room" onchange="this.form.submit()">
                <option value="">All Rooms</option>
                <?php
                    // Populate dropdown with rooms
                    while ($row = mysqli_fetch_assoc($resultRooms)) {
                        $roomId = $row['roomID'];
                        $roomName = $row['roomName'];
                        echo "<option value='$roomId' " . ($selectedRoom == $roomId ? 'selected' : '') . ">$roomName</option>";
                    }
                ?>
            </select>
        </form>
<br><br>
        <?php
            // Display reservations based on the selected room
            if (mysqli_num_rows($resultReservations) > 0) {
                echo "<table id='roomResTable' border='1'>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Room Name</th>
                            <th>Reserved by</th>
                            <th>Booking Date</th>
                            <th>Booking Time</th>
                            <th>Action</th>
                        </tr>";

                while ($reservationRow = mysqli_fetch_assoc($resultReservations)) {
                    echo "<tr>
                            <td>{$reservationRow['bookingID']}</td>
                            <td>{$reservationRow['roomName']}</td>
                            <td>{$reservationRow['username']}</td>
                            <td>{$reservationRow['booking_date']}</td>
                            <td>{$reservationRow['booking_time']}</td>
                            <td>
                                <a href='reserve_edit.php?id={$reservationRow['bookingID']}'>Edit</a>
                                <a href='reserve_delete.php?id={$reservationRow['bookingID']}'>Delete</a>
                            </td>

                        </tr>";
                }

                echo "</table>";
            } else {
                echo "No reservations found.";
            }
        ?>
    </div>
    <div class="addBtnDiv">
       <img class="icon" onclick="addFileDiv()" src="images/add_button.svg">
       <span class="addBtnTooltip">Make reservations</span>
    </div>

    <div id="addFileDiv">
            <span class="closeButton" onclick="closeAddFileDiv()">(X)</span><br>
            <form method="POST" action="reserve_action.php"  enctype="multipart/form-data"  id="myForm">
                <table border="1" id="addRoomTable">
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

    <?php include 'footer.php';?>
</body>

</html>
