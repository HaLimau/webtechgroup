<?php
    session_start();
    include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cetak Serumpun</title>
    <link rel="stylesheet" href="style/style.css"> 
</head>
<header>
    <h1>Cetak kertas bukan cetak rompak</h1>
</header>
<?php include 'menus/loggedout_menu.php';    ?>
<body>
    <div class="register"> <!--Please add the CSS to this in style.css!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1-->
        <form action="register_action.php" method="post">
            <table>
                <tr>
                    <td>Username :</td>
                    <td> <input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td> <input type="text" name="email" required></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td> <input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password :</td>
                    <td> <input type="password" name="Cpassword" required></td>
                </tr>
                <tr>
                    <td><button> Submit </button></td>
                    <td><button> Clear all</button></td>
                </tr>
                
            </table>
            
        </form>
    </div>


<?php include 'footer.php'?>
</body>

</html>
