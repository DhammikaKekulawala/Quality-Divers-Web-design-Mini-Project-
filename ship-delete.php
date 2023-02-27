<?php session_start(); ?>
<?php

    require_once("inc/connection.php");?>
<?php require_once('inc/function.php');?>	
	<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}

if(isset($_GET['Del']))
         {
             $UserID = $_GET['Del'];
             $query = " delete from records where Registration_Id= '".$UserID."'";
             $result = mysqli_query($connection,$query);
             if($result)
             {
                 header("location:users_details.php");
             }
             else
             {
                 echo ' Please Check Your Query ';
             }
        }
         else
         {
             header("location:users_details.php");
         }
      
?>   