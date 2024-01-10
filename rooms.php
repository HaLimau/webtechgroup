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
    <div style="text-align: right; padding:10px;">
			<form action="room_search.php" method="post">
				<input type="text" placeholder="Search.." name="search" autocomplete="off">
				<input type="submit" value="Search">
			</form>
		</div>
		<?php if($userType == 0){ ?>
        <div style="padding:0 10px;">
		<table border="1" width="90%" id="roomTable">
			<tr>
				<th>No</th>
				<th>Room Name</th>
				<th>Location</th>
				<th>Capacity</th>
				<th>Type</th>
				<th>Action</th>
			</tr>
			<?php
				$numrow = 1;
				$sql = "SELECT * FROM rooms";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0){
					while ($row = mysqli_fetch_assoc($result)){
                        $roomType = $row["roomType"];
                        if ($roomType == 1) {
                            $roomTypeName = "Hall";
                        } elseif ($roomType == 2) {
                            $roomTypeName = "Cubicle";
                        } elseif ($roomType == 3) {
                            $roomTypeName = "Seminar";
                        }else{
                            $roomTypeName = "Room Type Undefined";
                        }
                        
                        echo '<tr>';
                            echo '<td>' . $numrow . '</td>';
                            echo '<td>' . $row["roomName"] . '</td>';
                            echo '<td>' . $row["location"] . '</td>';
                            echo '<td>' . $row["capacity"] . '</td>';
                            echo '<td>' . $roomTypeName. '</td>';
                            echo '<td><a href="room_edit.php?id=' . $row["roomID"] . '">Edit </a>';
                            echo '<a href="room_delete.php?id=' . $row["roomID"] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
						$numrow++;
					}
				}else {
					echo '<tr><td colspan="7">0 results</td></tr>';
					}
			?>
		</table>
	</div>
    <?php } else{ ?>
            <div style="padding:0 10px;">
            <table border="1" width="90%" id="roomTable">
                <tr>
                    <th>No</th>
                    <th>Room Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Type</th>
                </tr>
                <?php
                    $numrow = 1;
                    $sql = "SELECT * FROM rooms";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                            $roomType = $row["roomType"];
                            if ($roomType == 1) {
                                $roomTypeName = "Hall";
                            } elseif ($roomType == 2) {
                                $roomTypeName = "Cubicle";
                            } elseif ($roomType == 3) {
                                $roomTypeName = "Seminar";
                            }else{
                                $roomTypeName = "Room Type Undefined";
                            }
                            
                            echo '<tr>';
                                echo '<td>' . $numrow . '</td>';
                                echo '<td>' . $row["roomName"] . '</td>';
                                echo '<td>' . $row["location"] . '</td>';
                                echo '<td>' . $row["capacity"] . '</td>';
                                echo '<td>' . $roomTypeName. '</td>';
                                echo '</tr>';
                            $numrow++;
                        }
                    }else {
                        echo '<tr><td colspan="7">0 results</td></tr>';
                        }
                        ?>
                        </table>
                    </div>
        <?php } ?>

        <br>
        <p style='text-align: right;'><a href="room_reserve.php">Go reserve a room</a></p>



    <?php 
         $check = "SELECT user_type FROM user WHERE userID=" . $_SESSION["UID"];
         $result = mysqli_query($conn, $check);
         $row = mysqli_fetch_assoc($result);
        if($row["user_type"] == 0){?>
    <div class="addBtnDiv">
       <img class="icon" onclick="addFileDiv()" src="images/add_button.svg">
       <span class="addBtnTooltip">Add File</span>
    </div>

    <div id="addFileDiv">
            <span class="closeButton" onclick="closeAddFileDiv()">(X)</span><br>
            <form method="POST" action="room_add_action.php"  enctype="multipart/form-data"  id="myForm">
                <table border="1" id="addRoomTable">
                    
                <tr>
                    <td cols="20" rows="4" name="newsTitle" maxlength="255">Room Name : </td>
                    <td>
                        <textarea name="roomName" class="noResize"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Location : </td>
                    <td>
                        <textarea name="location" class="noResize"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Capacity : </td>
                    <td>
                        <textarea type="number" name="capacity" class="noResize"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Room Type : </td>
                    <td>
                        <select name="roomType">
                            <option value="1">Hall</option>
                            <option value="2">Cubicle</option>
                            <option value="3">Seminar</option>
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
        <?php } ?>

    <?php include 'footer.php';?>
</body>

</html>
