<?php
    session_start();
    include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Library - Register</title>
    <link rel="stylesheet" href="style/login.css"> 
    <link rel="stylesheet" href="style/style.css"> 
</head>
<header>
    <h1>User Registration</h1>
</header>
<?php include 'menus/loggedout_menu.php';    ?>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="register-form" action="register_action.php" method="post">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" name="username" placeholder="Username" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-envelope"></i>
                        <input type="text" class="login__input" name="email" placeholder="Email" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="password" placeholder="Password" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="Cpassword" placeholder="Confirm Password" required>
                    </div>
                    <button class="button login__submit" type="submit">
                        <span class="button__text">Submit</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>        
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>      
        </div>
    </div>

    <?php include 'footer.php'?>
</body>


</html>
