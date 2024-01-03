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
    <title>Cetak Serumpun</title>

</head>
<header>
        <h1>Cetak kertas bukan cetak rompak</h1>
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



    <section>
        <h2>Welcome to Our Printing Services!</h2>
        <p>We're here to meet all your paper needs!</p>
    </section>
    <div class="cta">
        <h2>Ready to Get Started?</h2>
        <p>Click it! ↓</p>
        <a href="#">Start Printing</a>
    </div>

<?php include 'footer.php'?>
</body>

</html>
