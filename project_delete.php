<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	
	
	
	if(isset($_GET['registration_id'])){
		//getting the user information
		$registration_id = mysqli_real_escape_string($connection,$_GET['registration_id'] );
		
		
	
			
		$query = "UPDATE project SET is_delete =1 WHERE registration_id ={$registration_id} LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if($result){
			//user deleted
			header('Location:project.php?msg=user-deleted');
			
		}else{
			header('Location:project.php?err=delete_failed');
		}
			
			
		
	}else{
		header('Location:project.php');
	}

?>	
	
	
	
	