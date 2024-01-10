<?php
    session_start();
    include 'config.php';

    // Check if the user is already logged in
    if (isset($_SESSION["UID"])){
        header("Location: index.php"); // Redirect to the homepage if already logged in
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - University Library</title>
    <link rel="stylesheet" href="style/style.css"> 
</head>

<header>
<h1>User Registration</h1>
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
        <h2>Login</h2>
        <?php 
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
        ?>
        <form method="post" id="login" action="login_action.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </section>

    <div align=center>

            <a href ="register.php">Register </a>
    </div>

    <?php include 'footer.php'?>
</body>

</html>
