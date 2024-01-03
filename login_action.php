<?php
	session_start();
	include ("config.php");

	//login values from login form
	$userName = $_POST['username'];
	$userPwd = $_POST['password'];
	$sql = "SELECT * FROM user WHERE username='$userName' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
		//check password hash
		$row = mysqli_fetch_assoc($result);
		if ($_POST['password'] == $row['user_password']) {
			$_SESSION["UID"] = $row["userID"];//the first record set, bind to userID
			$_SESSION["name"] = $row["username"];
			//set logged in time
			$_SESSION['loggedin_time'] = time();
			header("location:login.php");
		} else {
			echo 'Login error, user username and password is incorrect.<br>';
			echo '<a href="login.php?login=1"> | Login |</a> &nbsp;&nbsp;&nbsp;
			<br>';
			}
	} else {
		echo "Login error, user <b>$userName</b> does not exist. <br>";//user not exist
		echo '<a href="login.php?login=1"> | Login |</a>&nbsp;&nbsp;&nbsp;
		<br>';
		}
	
	
	
	
	


		
mysqli_close($conn);
?>