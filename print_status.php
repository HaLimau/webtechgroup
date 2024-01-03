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
    <title>Printing Service - Printing Status</title>
</head>

<body>
    <div class="header">
        <h1>Printing Status</h1>
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

    <main>
        <div style="padding: 0 5px;" id="centerDiv">

            <h3 align="center">Printing Status</h3>

            <table border="1" width="100%" id="statusTable">
                <tr>
                    <th width="50%">File Name</th>
                    <th width="25%">Print Status</th>
                    <th width="25%">Actions</th>
                </tr>

                <?php
                $uploadDir = 'uploads/';
                $files = glob($uploadDir . '*');

                foreach ($files as $file) {
                    $fileName = basename($file);
                    $printStatus = getPrintStatus($fileName);

                    echo '<tr>';
                    echo '<td>' . $fileName . '</td>';
                    echo '<td>' . $printStatus . '</td>';
                    echo '<td><a href="update_print_status.php?filename=' . $fileName . '">Update Status</a></td>';
                    echo '</tr>';
                }

                function getPrintStatus($fileName)
                {
                    // You can implement logic to retrieve/printing status from a database or any other source
                    // For this example, let's assume all files are marked as "Pending"
                    return 'Pending';
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
