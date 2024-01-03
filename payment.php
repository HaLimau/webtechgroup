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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Serumpun</title>
    <link rel="stylesheet" href="style/style.css"> 
</head>

<body>
    <header>
        <h1>Cetak kertas bukan cetak rompak</h1>
    </header>
    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
 
        }
        else {
            include 'menus/loggedout_menu.php';
        }

    ?>

  <main>
    <section class="order-summary">
      <h2>Order Details</h2>
      <ul>
        <p>Order Number: <span id="order-number"></span></p>
        <p>Size: A4 size (210 mm x 297mm) - Portrait</p>
        <p>Paper Material: 80gsm Simili paper</p>
        <p>Printing side: Single sided</p>
        <p>Printing type (Single sided): B&W + Color printing</p>
        <p>Total B&W Pages (Single Sided): <span id="bw-pages"></span></p>
        <p>Total Color Pages (Single Sided): <span id="color-pages"></span></p>
      </ul>
      <div class="adjust-order">
        <button id="adjust-pages">Adjust Page Count</button>
      </div>
    </section>

  <section class="payment-options">
    <h2>Choose your payment method</h2>
    <div class="payment-method">
      <img src="img/dnw.png" height="5%" width="5%" alt="DuitNow"><br>
      <input type="radio" id="duitnow" name="payment-method" value="DuitNow">
      <label for="duitnow">
        <span>DuitNow Transfer [01102847128749266 (MayBank, Printing)]</span>
      </label>
    </div>
    <div class="payment-method">
      <img src="img/qr.png" alt="QR Code"><br>
      <input type="radio" id="qr-code" name="payment-method" value="qr-code">
      <label for="qr">
        <span>QR Code Transfer</span>
      </label>
    </div>
  </section>

    <section class="payment-form">
      <h2>Billing Information</h2>
      <form id="payment-form">
        <label for="name">Name:</label>
        <input type="text" id="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" required>
        <label for="address">Address:</label>
        <textarea id="address" required></textarea>
        <div class="payment-info">
          <h2>Payment Information</h2>
        </div>
        <label for="receipt">Upload Receipt:</label>
        <input type="file" id="receipt"><br><br>

        <button type="submit">Pay Now</button>
      </form>
    </section>
  </main>

<?php include 'footer.php'?>

    <script src="scripts.js"></script>
</body>
</html>
