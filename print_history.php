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
    <?php include 'head.php'?>
	<title>Printing Service</title>
</head>

<body>
	<div class="header">
		<h1>Print History</h1>
	</div>

	<?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {
            include 'menus/loggedout_menu.php';
            
        }

    ?>


<?php
// Define the directory for storing print history files
$printHistoryDir = 'print_history/';

// Check if the print history directory exists, if not create it
if (!file_exists($printHistoryDir)) {
    mkdir($printHistoryDir, 0777, true);
}

// Get the list of print history files
$printHistoryFiles = scandir($printHistoryDir);
?>

<br></br>

<main>
    <div style = "padding: 0 5px;" id = "challengeDiv">
        <table border="1" width="100%" id="printHistoryTable">
            <tr>
                <th>File Name</th>
                <th>Print Date</th>
            </tr>

            <?php
            foreach ($printHistoryFiles as $printHistoryFile) {
                if ($printHistoryFile != '.' && $printHistoryFile != '..') {
                    // Display the file name and print date
                    echo '<tr>';
                    echo '<td>' . $printHistoryFile . '</td>';
                    echo '<td>' . date('Y-m-d H:i:s', filemtime($printHistoryDir . $printHistoryFile)) . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</main>

<br></br>

<footer> &copy; 2023 Printing Services. All rights reserved. </footer>



	<script>
	//for responsive sandwich menu
	function myFunction() {
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
	}
	</script>

</body>

</html>
