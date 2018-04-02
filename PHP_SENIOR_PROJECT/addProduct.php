<!DOCTYPE html>
<html>
<?php include "head.php"; ?>
<body>
<?php include "includes/connectDB.inc.php"; ?>
	
	<div id="wrapper">
        <div id="content">
			<?php include "navbar.php";?>
            <div id="main">
				<h2>&nbsp;&nbsp;Add a New Product</h2>
				<div class="container dark">
					<form id="register" name="register" method="post" action="addProduct.php" enctype="multipart/form-data">
						Product Name: 
						<input type="text" id="name" name="name"><br><br>
						Description: 
						<input type="text" id="description" name="description"><br><br>
						Price: 
						<input type="text" id="price" name="price"><br><br>
						Quantity: 
						<input type="text" id="quantity" name="quantity"><br><br>
						Type: 
						<select name="type" id="type" required>
						<option value="Hair">Hair</option>
						<option value="Face">Face</option>
						<option value="Cosmetics">Cosmetics</option>
						<option value="Body">Body</option>
						</select>
				


						<!-- upload image fields here -->

						<legend>Upload Photo of Product</legend><br/>
						<input type="file" name="fileToUpload" id="fileToUpload">
						<br><br>
						<input type="submit" class="button_style" value="Add Product" name="submit"><br>
					</form>
				</div>

			</div>
			
		</div>

		<?php include "footer.php";?>
		
								<?php
			
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$name = basename($_FILES["fileToUpload"]["name"]);
					
					echo "<br>".$target_file."<br>";
					echo "<br>".$_FILES["fileToUpload"]["name"]."<br>";
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
					} else {
					echo "File is not an image.";
					$uploadOk = 0;
					}
					}
					// Check if file already exists
					if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
					}
					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 500000000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					
					$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					
					// if everything is ok, try to upload file
					} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					} else {
				
					}
					}

					// insert data to the database

					$sql = "INSERT INTO Product(productName, description, quantity, price, image, type) VALUES ('".
					$_POST['name'].
					"', '".
					$_POST['description'].
					"', ".
					$_POST['quantity'].
					", ".
					$_POST['price'].
					", '". 
					$name.
					"', '". 
					$_POST['type'].
					"')";

					// actual insertion takes place here
					if ($_POST['name'] != "" )
					{
						mysqli_query($db_Connection, $sql) or die(mysql_error());
						echo "<script>";
                        echo "alert('Product has been Added!');";
                        echo "window.location.href = 'displayProduct.php';";
                        echo "</script>";
					}

					mysqli_close($db_Connection);
				?>
	</div>
</body>
</html>













