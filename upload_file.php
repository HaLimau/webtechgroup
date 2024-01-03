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
<html>

<head>
	<?php include 'head.php';?>
	<title>Printing Service</title>
</head>

<body>
	<div class="header">
		<h1>File Upload</h1>
	</div>

	<?php 
        if (isset($_SESSION["UID"])){
            include 'menus/menunav.php';
            //add if admin, different menu againa
        }
        else {
            include 'menus/loggedout_menu.php';
            
        }

    ?>


	<div style = "padding: 0 5px;" class = "uploadPrint">
		<h3 align = "center">Add File to Print</h3>
		<form method="POST" action="upload_file_action.php"  enctype="multipart/form-data"  id="myForm">
			<table border="1" id="myTable">
				
				<tr>
					<td>Upload file : </td>
					<td>
						Max size: 20MB<br>
						<input type="file" name="fileToUpload" id="fileToUpload" accept=" .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .rtf, .odt, .ods, .odp, .tex, .md, .epub, .csv, .html, .htm .jpg, .jpeg, .png" required>
					</td>
				</tr>
				
				<tr>
					<td colspan="3" align="right"> 
					<input type="submit" value="Upload" name="B1">                
					<input type="reset" value="Reset" name="B2">
				</tr>
				
			</table>
		</form>
	</div>


<br></br>

<footer> &copy; 2023 Printing Services. All rights reserved. </footer>



	<script>
	//for responsive sandwich menu
	function myFunction() {
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
	}
	</script>

</body>

</html>