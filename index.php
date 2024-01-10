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
<head>

    <?php include 'head.php';?>
    <title>Home Page</title>

</head>
<header>
        <h1>University Library System</h1>
    </header>
    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {
            include 'menus/loggedout_menu.php';
            
        }

    ?>
<body>
        <div class="row">
            <div class="row-left"></div>
            <div class="row-right"></div>
                

        </div>

<?php include 'footer.php'?>
</body>

</html>
