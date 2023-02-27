<?php session_start(); ?>
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "diver";
 
$connection = mysqli_connect($servername, $username, $password, $databasename);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
	// echo "Connection Successfull";
}
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

$query = "SELECT * FROM gal where Is_Delete = 0";

$result = mysqli_query($connection, $query);

echo "<table id = 'records' class='ttt'>";
echo "<tr>";
	echo "<th style = width:50px;>Id</th>";
	echo "<th style = width:150px;>Title</th>";
	echo "<th style = width:150px;>Image</th>";
	echo "<th style = width:50px;>Delete</th>";
echo "</tr>";

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){

		echo "<tr>
				<td>", $row['Id'], "</td>
				<td style = text-align: left;>",$row['Title'], "</td>
				<td><img src='gallery/".$row['Image']." ' class='imag'> </td>
				<td><a href=gallerydelete.php?Id={$row['Id']}\" onclick =\"return confirm('Are You Sure to remove this image?');\" class='delete'>Delete</a></td>
			  </tr>";
		
	}

}

else {
	// echo "Empty table";
}

echo"</div>";

mysqli_close($connection);

?>

<!DOCTYPE html>
<html>
<head>
<title>Gallery</title>
<link rel="stylesheet" href="css/gallery.css">
<style>
  h1{
	text-align: center;
	font-size:48px;
}
</style>
</head>

<body>
<header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  
	<br>
	<nav class="top-bar" role="navigation">
        <ul class="left">
           
           <li><a href="userviewgallery.php">View Gallery</a></li>
		   <li><a href="#" id="myBtn1">Add Photo</a></li>
		   <li><a href="gallery.php">Refresh</a></li>
		   
        </ul>
	</nav>
<br><br>
<br><br>
	<div class="box">

		<!-- The Modal -->
		<div id="myModal1" class="modal">
	
		<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="close">&times;</span>
				</div>
			
				<div class="modal-body">
					
					<h1>Upload Image</h1>
					
					<form action="gallerydata.php" method="POST" enctype="multipart/form-data" data-abide>
		
						<div class="photo">
							<label>Browse for an image for upload : </label>
							<input value = "click here" type="file" name="image" pattern="^.+?\.(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|tiff|TIFF|bmp|BMP)$" required><br>
							<small class="error">Images extensions should be : JPG,JPEG,PNG,GIF,TIFF or BMP</small>
						</div>
						
						<br>
					
						<div class="title">
							<label>Add a title for the image : &nbsp &nbsp &nbsp &nbsp &nbsp </label>
							<input type="text" name="title" placeholder="Image title" required><br>
							<small class="error">Image title is required.</small>
						</div>

						<br>
						
						<div class= "submit">
							<input type="submit" value="Upload Image" name="btn_upload" class="button">
						</div>
		
					</form>

				</div>

				<div class="modal-footer"></div>
	
			</div>

		</div>
	
	</div>

    <script>
        var datamap = new Map([
            [document.getElementById("myBtn1"), document.getElementById("myModal1")]
        ]);

        datamap.forEach((value, key) => {
            doModal(key, value);
        });

        function doModal(anchor, popupbox) {

            // Get the <span> element that closes the modal
            var span = popupbox.getElementsByClassName("close")[0];

            anchor.addEventListener("click", function (event) {
                popupbox.style.display = "block";
            });

            span.addEventListener("click", function (event) {
                popupbox.style.display = "none";
            });

            window.addEventListener("click", function (event) {
                if (event.target == popupbox) {
                    popupbox.style.display = "none";
                }
            });
        }
    </script>

<div class="bgc">
<center><br>
<h1>Image Gallery</h1>
</center>

<?php echo "</table>";
   
?>
<br><br>
</div>
</body>
</html>
