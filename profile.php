<?php
    include 'config.php';
    session_start();
    $sql = "SELECT * FROM user WHERE userID=" . $_SESSION["UID"];
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $userID = $row ["userID"];
    $username = $row ["username"];
    $email= $row ["email"];
    $userType = $row ["user_type"];
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
        <h1>User Profile</h1>
    </div>

    <?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {include 'menus/loggedout_menu.php';}
    ?>
    <div class="row">
        <div class="col-left">
            <!-- User Account Information -->
            <table>
                <tr>
                    <td>Username</td>
                    <td><?php echo $username ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <td>User Type</td>
                    <td>                    
                        <?php
                        switch ($userType) {
                            case 1:
                                echo "Student";
                                break;
                            case 2:
                                echo "Staff";
                                break;
                            case 3:
                                echo "Outsider";
                                break;
                            case 0:
                                echo "Admin";
                                break;
                            default:
                                echo "Unknown";
                        }
                        ?></td> 
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>

            </table>
        </div>
        <!-- NNt kau tambah ni tolong thanks -->
        <!--Right Lieft Column comment divider to see where it is sdsadsadsadadsadsa-->
        <div class="col-right">
            <!-- User divs that show different things depending on button clicked -->
            <!-- The buttons here -->
            <div align=center>
                <button id="sec1" onclick="showSection('borrowedhistorysection')">Book History</button>
                <button id="sec2" onclick="showSection('reviewsSection')">Reviews</button>
                <button id="sec3" onclick="showSection('printordersection')">Print Orders</button>

            </div>

            <!-- Past Book Borrowed History -->
            <div id="borrowedhistorysection" class="profile-section">
                <h2>Past Borrowed Books</h2>
                <?php
                $borrowedBooksSQL = "SELECT * FROM borrows JOIN books ON borrows.bookID = books.bookID
                WHERE borrows.userID = $userID";
                $borrowedBooksResult = mysqli_query($conn, $borrowedBooksSQL);

                if (mysqli_num_rows($borrowedBooksResult) > 0) {
                    echo '<table width="100%">';
                    echo '<tr><th>Book Title</th><th>Borrowed Date</th></tr>';

                    while ($bookRow = mysqli_fetch_assoc($borrowedBooksResult)) {
                        echo '<tr>';
                        echo '<td>' . $bookRow['title'] . '</td>';
                        echo '<td>' . $bookRow['start_date'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                } else {
                    echo 'No past borrowed books.';
                }
                ?>
            </div>
            <!-- Review Section -->
            <div id="reviewsSection" class="profile-section">
                <h2>Book Reviews</h2>
                <?php
                $reviewsSQL = "SELECT * FROM book_reviews JOIN books ON book_reviews.bookID = books.bookID WHERE userID = $userID";
                $reviewsResult = mysqli_query($conn, $reviewsSQL);

                if (mysqli_num_rows($reviewsResult) > 0) {
                    echo '<table width="100%">';
                    echo '<tr><th>Book Title</th><th>Comment</th><th>Action</th></tr>';

                    while ($reviewRow = mysqli_fetch_assoc($reviewsResult)) {
                        echo '<tr>';
                        echo '<td>' . $reviewRow['title'] . '</td>';
                        echo '<td>' . $reviewRow['comment'] . '</td>';
                        echo '<td><a href="book_review_edit.php?id='. $reviewRow["review_id"] . '"> Edit</a> | ';
                        echo '<a href="book_review_delete.php?id=' . $reviewRow["review_id"] . '">Delete</a></td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                } else {
                    echo 'No reviews yet.';
                }
                ?>
            </div>


            <!-- Print Order History -->
            <div id="printOrderSection" class="profile-section">
                <h2>Print Order History</h2>
                <?php
                $printOrdersSQL = "SELECT * FROM print_requests WHERE userID = '$userID'";
                $printOrdersResult = mysqli_query($conn, $printOrdersSQL);

                if (mysqli_num_rows($printOrdersResult) > 0) {
                    echo '<table width="100%">';
                    echo '<tr><th>Filename</th><th>Order Date</th></tr>';

                    while ($orderRow = mysqli_fetch_assoc($printOrdersResult)) {
                        echo '<tr>';
                        echo '<td>' . $orderRow['file_name'] . '</td>';
                        echo '<td>' . $orderRow['datetime_req'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                } else {
                    echo 'No past print orders.';
                }
                ?>
            </div>
        </div>
    </div>
    

   <?php include 'footer.php';?>

</body>

</html>
