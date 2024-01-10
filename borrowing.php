<?php
    include 'config.php';
    session_start();
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
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
        <h1>Borrow Book</h1>
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
    <p style="font-size: 25px;">Here are The List of Borrowed Books Information and Status</p>
    <div style="text-align: right; padding:10px;">
			<form action="room_search.php" method="post">
				<input type="text" placeholder="Search.." name="search" autocomplete="off">
				<input type="submit" value="Search">
			</form>
		</div>
		<div style="padding:0 10px;">
        <?php if($userType == 0 ){ ?>
		<table border="1" width="90%" id="roomTable">
			<tr>
				<th>No</th>
                <th>User ID</th>
				<th>Book ID</th>
				<th>Start Date</th>
				<th>Due Date</th>
				<th>Return Status</th>
                <th>Action</th>
			</tr>
			<?php
				$numrow = 1;
				$sql = "SELECT borrows.*, books.title, user.username
                FROM borrows
                JOIN books ON borrows.bookID = books.bookID
                JOIN user ON borrows.userID = user.userID
                GROUP BY borrows.bookID
                ORDER BY MAX(borrows.start_date) DESC
                LIMIT 1";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0){
					while ($row = mysqli_fetch_assoc($result)){

                        //row connected to borrows table
                        echo '<tr>';
                            echo '<td>' . $numrow . '</td>';
                            echo '<td>' . $row["username"] . '</td>';
                            echo '<td>' . $row["title"] . '</td>';
                            echo '<td>' . $row["start_date"] . '</td>';
                            echo '<td>' . $row["due_date"] . '</td>';
                            echo '<td>' . $row["return_status"]. '</td>';
                            echo '<td><a href="borrow_edit.php?id=' . $row["borrowID"] . '">Edit </a>';
                            echo '<a href="borrow_delete.php?id=' . $row["borrowID"] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
						$numrow++;
					}
				}else {
					echo '<tr><td colspan="7">0 results</td></tr>';
					}
                }else{ ?>
        <table border="1" width="90%" id="roomTable">
			<tr>
				<th>No</th>
                <th>User ID</th>
				<th>Book ID</th>
				<th>Start Date</th>
				<th>Due Date</th>
				<th>Return Status</th>
			</tr>
                <?php
                $numrow = 1;
				$sql = "SELECT borrows.*, books.title, user.username
                FROM borrows
                JOIN books ON borrows.bookID = books.bookID
                JOIN user ON borrows.userID = user.userID
                GROUP BY borrows.bookID
                ORDER BY MAX(borrows.start_date) DESC
                LIMIT 1";

				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0){
					while ($row = mysqli_fetch_assoc($result)){

                        //row connected to borrows table
                        echo '<tr>';
                            echo '<td>' . $numrow . '</td>';
                            echo '<td>' . $row["username"] . '</td>';
                            echo '<td>' . $row["title"] . '</td>';
                            echo '<td>' . $row["start_date"] . '</td>';
                            echo '<td>' . $row["due_date"] . '</td>';
                            echo '<td>' . $row["return_status"]. '</td>';
                            echo '</tr>';
						$numrow++;
					}
				}else {
					echo '<tr><td colspan="7">0 results</td></tr>';
					}
            
                 }

			    ?>
		</table>
	</div>

    <?php include 'footer.php';?>
</body>

</html>