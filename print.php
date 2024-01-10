<?php
    include 'config.php';
    session_start();
    $check = "SELECT * FROM user WHERE userID=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);
    $userID = $row["userID"];
    if (!isset($_SESSION["UID"])) {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php';?>
    <script src="scripts/scripts.js" defer></script>
    <title>University Library</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="header">
        <h1>Library Print Service</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {include 'menus/loggedout_menu.php';}
    ?>

    <div class="print-form">
        <form action="print_process.php" method="post" enctype="multipart/form-data">

            <label for="file">Select File to Print:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf, .doc, .docx" required><br><br>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br><br>
            <input type="hidden" name="userID" id="userID" value=<?=$userID?>>

            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" required><br<br><br><br>

            <label for="request_time">Collection Time:</label>
            <input type="datetime-local" name="request_time" id="request_time" required><br><br>

            <input type="hidden" name="submit" value="1">

            <button type="submit">Submit File to Print</button>
        </form>

        <?php
            // Display success message if file submission was successful
            if (isset($_GET['success'])) {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Your file has been submitted successfully. Please collect it at the library counter."
                        });
                      </script>';
            }
        ?>
    </div>

   <?php include 'footer.php';?>

</body>

</html>
