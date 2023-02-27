<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	
	
	
	if(isset($_GET['vessels_id'])){
		//getting the user information
		$vessels_id = mysqli_real_escape_string($connection,$_GET['vessels_id'] );
		
		
	
			
		$query = "UPDATE vessels SET is_deleted =1 WHERE vessels_id ={$vessels_id} LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if($result){
			//user deleted
			header('Location:vessels.php?msg=user-deleted');
			
		}else{
			header('Location:vessels.php?err=delete_failed');
		}
			
			
		
	}else{
		header('Location:vessels.php');
	}

?>	
	
	
	
	