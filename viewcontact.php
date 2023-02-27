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
	// echo "connection Successfull";
}
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
$query = 'SELECT * FROM contact WHERE Is_Delete=0';

$resultser = mysqli_query($connection, $query) or die(mysqli_error($connection));

if ($resultser) {
	
	 mysqli_num_rows($resultser) . " Records found.";

	$table = '<table>';
	$table .= '	<th style = "width: 100px">ID</th>
				<th style = "width: 300px">E-mail</th>
				<th style = "width: 600px">Message</th>
				<th style = "width: 100px">Delete</th>';
	
	while ($record = mysqli_fetch_assoc($resultser)){
		
		$table .= '<tr>';
		$table .= '<td style = "text-align: center">' . $record['ID'] . "</td>";
		$table .= '<td>' . $record['E-mail'] . "</td>";
		$table .= '<td>' . $record['Message'] . "</td>";
		$table .= "<td style = 'text-align: center'><a href=\"contact_delete.php?ID={$record['ID']}\" onclick =\"return confirm('Are You Sure to remove this data?');\" class='delete'>Delete</a></td>";
		$table .= '</tr>';
	}
	
	$table .= '</table>';

}

else {
	echo "Query not successful";
}

mysqli_close($connection);

?>


<!DOCTYPE html>
<html>
<head>
<title>View</title>

<style>

	body {
		height: 100%;
		width:100%;
		font-weight:bold;
		animation: myanimation 3600s infinite;
	}

	@keyframes myanimation {
		0% {background-color: Seashell;}
		10%{background-color: Pearl;}
		20%{background-color: Pink Bubble Gum;}
		30%{background-color: Parchment;}
		40% {background-color: Lemon Chiffon;}
		50% {background-color: light Jade;}
		60%{background-color: Light Slate;}
		70%{background-color: Azure;}
		80%{background-color: Alice Blue;}
		90%{background-color: Light Cyan;}
		100% {background-color: seashell;}
	}

	table {
		border-collapse: collapse;
		width: 80%;
		overflow-x: scroll;	
		margin-left: 10%;
		margin-right: 10%;
		table-align: center;
	}

	th {
		border: 1px solid black; 
		padding: 10px;
		background-color: black;
		color: white;
	}
	
	td {
		border: 1px solid black; 
		padding: 10px;
		
	}
	
	.divScroll {
		overflow:scroll;
		height:100px;
		width:200px;
	}
	header{
	background-color: yellow;
	overflow: auto;
	padding: 10px;
	}
	header .appname{
	    float: left;
	}
	header .loggedin{
	float: right;
	
	}
	.delete{
        background-color: #E7112B ;
		color: white;
		padding: 12px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		}
	center{
		background-color:white;
		width:80%;
		margin-left:200px;
	}
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
<center>
<br>
<br>
<h1>Contact Us Details</h1>


<?php echo $table; ?>
<br>
<br>
</center>

</body>
</html>




