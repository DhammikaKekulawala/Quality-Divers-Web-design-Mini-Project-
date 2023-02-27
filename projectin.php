<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
$user_list ='';


$query = "SELECT * FROM project  WHERE is_delete=0  ORDER BY ship_name";

$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td rowspan='6'><img src='images/".$user['image']. "' class='image'> </td>";
		$user_list .= "<td>Ship_name</td>";
		$user_list .= "<td>{$user['ship_name']}</td>";
		$user_list .= "</tr>";
		$user_list .= "<tr>";
		$user_list .= "<td>Registration id</td>";
		$user_list .= "<td>{$user['registration_id']}</td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Country</td>";
		$user_list .= "<td>{$user['country']}</td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Type</td>";
		$user_list .= "<td>{$user['type']}</td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Job Description</td>";
		$user_list .= "<td>{$user['job_description']}</td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Other</td>";
		$user_list .= "<td>{$user['other']}</td>";
		$user_list .= "</tr>";
		$user_list .= "<tr>";
        $user_list .= "<td><br><hr></td>";
		$user_list .= "<td><br><hr></td>";
		$user_list .= "<td><br><hr></td>";
		$user_list .= "</tr>";
		
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>project Details</title>
<link rel="stylesheet" href="css/main1.css">
<style>
.project1 { 
	  display: none;
	  margin-left:25%;
	 
	  
}
 .project1 .masterlist1{
	margin-left: auto;
   margin-right: auto;
}
.project1 table td{
	
}
@media screen and (max-width: 1400px) {
	.project .image { width: 200px; height:200px }
	.project table { width: 100%; }
	
	
}	
@media screen and (max-width: 1200px) {
	.project { display: none }
	.project1 { display: block }
	
}	 
@media screen and (max-width: 750px) {
	.project { display: none }
	.project1 { display: block }
	.project1 {  margin-left:15%; }
	
}	
@media screen and (max-width: 600px) {
	.project { display: none }
	.project1 { display: block }
	.project1 {  width:100%; margin:0px; }
	.project1 .image { width: 100%; height:250px }
	
}	
</style>
</head>
<body>
<?php 
 require_once('header.php');?>
<div class="cont">

  
 <div class="project">
 <br>
 <table class="masterlist" >
 <tr> </tr><tr> </tr>
  <tr>
      <th colspan="3">Our projects</th>
  </tr>
  <tr> </tr><tr> </tr>
  <tr> </tr><tr> </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <?php echo $user_list; ?>
 </table>
</div>
</div>
  
  
 <?php
$user_list1 ='';


$query = "SELECT * FROM project  WHERE is_delete=0  ORDER BY ship_name";

$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list1 .= "<tr>";
		$user_list1 .= "<td colspan='2'><img src='images/".$user['image']. "' class='image'> </td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
		$user_list1 .= "<td>Ship_name</td>";
		$user_list1 .= "<td>{$user['ship_name']}</td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
		$user_list1 .= "<td>Registration id</td>";
		$user_list1 .= "<td>{$user['registration_id']}</td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Country</td>";
		$user_list1 .= "<td>{$user['country']}</td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Type</td>";
		$user_list1 .= "<td>{$user['type']}</td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Job Description</td>";
		$user_list1 .= "<td>{$user['job_description']}</td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Other</td>";
		$user_list1 .= "<td>{$user['other']}</td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
		$user_list1 .= "<td><br></td>";
		$user_list1 .= "<td><br></td>";
		$user_list1 .= "</tr>";
		
	}

?>

<div class="cont">

  
 <div class="project1">

 <br>
 <table class="masterlist1" >
 <tr> </tr><tr> </tr>
  <tr>
  <th colspan="3">Our projects</th>
  </tr>
  <tr> </tr><tr> </tr>
  <tr> </tr><tr> </tr>
  <tr> </tr><tr> </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <?php echo $user_list1; ?>
 </table>
</div>
</div>
  <?php
   require_once('footer.php');?>
</body>

</html>