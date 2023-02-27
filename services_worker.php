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
	//echo "connection Successfull";
}
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
$user_id= $_GET['user_id'];

$query = "SELECT * FROM service WHERE Is_Delete=0 AND user_id=$user_id";

$resultser = mysqli_query($connection, $query) or die(mysqli_error($connection));

if ($resultser) {
	
	 mysqli_num_rows($resultser) . " Records found.";
$table = '';
	$table1 = '<table>';
	 $number =  mysqli_num_rows($resultser);
	$table2 = '';
				
   $count =0;
	
	

		if($number == 0){
			$table2 .= '<h1>Data not Entered</h1>';
			}else{
		          $table1 .= '	<th style = "width: 200px">  First Name  </th>
				<th style = "width: 200px">Last Name</th>
				<th style = "width: 200px">Company</th>
				<th style = "width: 200px">Ship Name</th>
				<th style = "width: 200px">Ship ID</th>
				<th style = "width: 100px">Length</th>
				<th style = "width: 100px">Width</th>
				<th style = "width: 100px">Height</th>
				<th style = "width: 200px">Country</th>
				<th style = "width: 300px">E-mail</th>
				<th style = "width: 100px">Area Code</th>
				<th style = "width: 100px">Phone</th>
				<th style = "width: 100px">Under Water</th>  
				<th style = "width: 100px">Above Water</th>  
				<th style = "width: 300px">Other</th>';
				
	
	    
				   }
			
		
		
	while ($record = mysqli_fetch_assoc($resultser)){
		$table .= '<tr>';
		$table .= '<td>' . $record['First_Name'] . "</td>";
		$table .= '<td>' . $record['Last_Name'] . "</td>";
		$table .= '<td>' . $record['Company'] . "</td>";
		$table .= '<td>' . $record['Ship_Name'] . "</td>";
		$table .= '<td>' . $record['Ship_ID'] . "</td>";
		$table .= '<td>' . $record['Length'] . "</td>";
		$table .= '<td>' . $record['Width'] . "</td>";
		$table .= '<td>' . $record['Height'] . "</td>";
		$table .= '<td>' . $record['Country'] . "</td>";
		$table .= '<td>' . $record['E-mail'] . "</td>";
		$table .= '<td>' . $record['Area_Code'] . "</td>";
		$table .= '<td>' . $record['Phone'] . "</td>";
		$table .= '<td>' . $record['Under_Water'] . "</td>";
		$table .= '<td>' . $record['Above_Water'] . "</td>";  
		$table .= '<td>' . $record['Other'] . "</td>";
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
		width: 3500;
		overflow-x: scroll;	
		margin-left: 10px;
		margin-right: 10px;
		table-layout: auto;
	}

	th {
		border: 1px solid black; 
		padding: 10px;
		background-color: black;
		color: Cyan;
		font-size: 18px;
		text-align: center;
		
	}
	
	td {
		border: 1px solid black; 
		padding: 10px;
		text-align: center;
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
	width:3500px;
    }
     header .appname{
	 float: left;
     }
      header .loggedin{
	    float: right;
	
     }
	.back{
		 background-color:white;
	    width:3550px;
	 }
	.backto{
      margin-left:10px;
	  
    }
    .backto a{
      background: blue;
      color: white;
      padding: 12px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size:16px;
    }
	h1{
	text-align: center;
	font-size:48px;
   }

</style>

</head>

<body>
<header>
    <div class="appname"><a href="worker.php">Worker Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
<div class="back">
<center> 
<h1>Services Details</h1>

<?php

echo $table1;
echo $table2;
echo $table;
?>
<br>
<br>
</center>

<div class="backto"><a href="display-users.php">Back</a></div>
</div>

</body>
</html>