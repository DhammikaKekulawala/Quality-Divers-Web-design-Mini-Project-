<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Comment Box</title>
<style>

body{
	margin:0px;
	font-family:Baskerville, 'Palatino Linotype', Palatino, 'Century Schoolbook L', 'Times New Roman', serif;
	}

input[type=text], select {
    width: 100%;
	border-radius: 5px;
	margin: 7px 0;
	border: 1px solid #ccc;
    padding: 14px 18px; 
    display: inline-block;
    box-sizing: border-box;
	width:800px;
}

input[type=submit]:hover {
    background-color: #00a7d1;
}

textarea, select {
   width: 100%;
	border-radius: 5px;
	margin: 7px 0;
	border: 1px solid #ccc;
    padding: 14px 18px; 
    display: inline-block;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
	border: none;
	color: white;
	padding: 14px 20px;
    background-color: #01c9fb;
    margin: 8px 0;
	cursor: pointer;
    border-radius: 4px;
    
}
.back{
	width: 100%;
	border: none;
	color: white;
	padding: 10px 14px;
    background-color: #01c9fb;
    margin: 8px 0;
	cursor: pointer;
    border-radius: 4px;
	text-decoration: none;
    margin-right:0px;
}
.comment{
  margin-top:100px;
  font-size:20px;
  
}
.co{
		width:1000px;
		 opacity:0.8;
		 background-color:#b0b0b0;
}
header{
	background-color: yellow;
	overflow: auto;
	padding: 10px;
	color:black;
	margin-top:0px;
	margin-right:0px;
	margin-right:0px;
}
 header .appname{
	 float: left;
	 background-color: yellow;
}
header .loggedin{
	float: right;
	 background-color: yellow;

}
h1{
	text-align: center;
	font-size:48px;
}
main{
	opacity:0.8;
  background-color:white;
  width:1190px;
  margin-left:20%;
  font-size:16px;
  
}
@media screen and (max-width: 1550px) {
	main {margin-left:10%; width:1000px;}
}
@media screen and (max-width: 1150px) {
	main {margin-left:0%; width:1000px;}
	table{ width:50%;}
}
@media screen and (max-width: 950px) {
	main {margin-left:10%; width:500px; }
	table{ width:100%;}
	.co{ width: 100%;}
	input[type=text], select{ width:100%; margin:0px;padding:0px;}
}
@media screen and (max-width: 550px) {
	main {margin-left:1%; width:98%; }
	table{ width:100%;}
	.co{ width: 100%;}
	input[type=text], select{ width:100%; margin:0px;padding:0px;}
}
</style>

</head>
<body style="background-image: url('IMG_7343-1024x760.png'); background-size:cover;background-attachment: fixed;">

<header>
    <div class="appname"><a href ="user.php">User Panel</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
<div class="comment">

<table  style="padding:50px" align="center">
<form action="" method="post">
<tr>
<th colspan="2"><h2>Comment Box</h2></th>
</tr>
<tr>
<td> Name : </td><td><input type="text" name="name"></td>
</tr>
<tr>
<td>Product name : </td><td><input type="text" name="product_name" list="product"></td>
<datalist id="product">
	<option value="Accessories"></option>
	<option value="Boat Towed Meta"></option>
	<option value="BRUSH-KART"></option>
	<option value="Hand Held Metal"></option>
	<option value="HYDRAULIC POWER"></option>
	<option value="MINI BRUSH-KART"></option>
	<option value="Pali BilgeSafe"></option>
	<option value="Pingers and Pin"></option>
	<option value="Portable Cabin"></option>
	<option value="Remote Operated"></option>
	<option value="Sonar Systems"></option>
	<option value="Underwater Cam"></option>
</datalist>
</tr>
<tr>
<td> Comment : </td><td><textarea name="comment" rows="6" cols="50"></textarea></td>
</tr>
<tr>
<td><input type="submit" name="submit"></td><td><span><a href="product-user.php" class="back">Back</span></td></tr>

</form>
</table>
</div>


<?php
if(isset($_POST["submit"]))
{
 
 //Including dbconfig file.
//include 'dbconfig.php';
 
$name =  mysqli_real_escape_string($connection,$_POST["name"]);
$product_name =  mysqli_real_escape_string($connection,$_POST["product_name"]);
$comment =  mysqli_real_escape_string($connection,$_POST["comment"]);


$query="INSERT INTO comment (name,comment,product_name) VALUES ('$name','$comment','$product_name')"; 

$result = mysqli_query($connection,$query);
//$result = mysqli_query($connection,$query);


  if($result){
    //echo '<center> Comment Successfully Submitted </center>';
  }
}

 ?>
 <?php
   $user_list='';
 $query="SELECT*FROM comment";
 

  $users= mysqli_query($connection,$query);



	while($user = mysqli_fetch_assoc($users)){
		
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['name']}</td>";
		$user_list .= "<td>{$user['product_name']}</td>";
		$user_list .= "<td>{$user['comment']}</td>";
		$user_list .= "</tr>";
        
		
	}

?>

 <table bgcolor="#f2f2f2" style="padding:50px" align="center" class="co" >
  <tr>
      <th colspan="2">Comment</th>
  </tr>
  <tr>
  </tr>
  <?php echo $user_list; ?>
 </table>
</div>
</main>
</body>

</html>

</body>
</html>