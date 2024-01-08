<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
<body>
<?php
//STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query,
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$userName = mysqli_real_escape_string($conn, $_POST['username']);
		$userEmail = mysqli_real_escape_string($conn, $_POST['email']);
		$userPwd = mysqli_real_escape_string($conn, $_POST['password']);
		$confirmPwd = mysqli_real_escape_string($conn, $_POST['Cpassword']);
		//Validate pwd and confrimPwd
		if ($userPwd !== $confirmPwd) {
			die("Password and confirm password do not match.");
		}
		//STEP 2: Check if userEmail already exist
		$sql = "SELECT * FROM user WHERE email='$userEmail' or
		username='$userName' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 1) {
			echo "<p ><b>Error: </b> User exists, please register with a different username or email</p>";
		} 
			else { // User does not exist, insert new user record, hash the password
				$pwdHash = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
				//echo $pwdHash;
				$sql = "INSERT INTO user (username, email, user_password ) VALUES
				('$userName', '$userEmail', '$pwdHash')";
				$insertOK=0;
				if (mysqli_query($conn, $sql)) {
				echo "<p>New user record created successfully.</p>"; $insertOK=1;
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
	}
mysqli_close($conn);
?>
<p><a href="register.php"> | Login |</a></p>
</body>
</html>