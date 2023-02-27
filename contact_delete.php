<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	
	
	
	if(isset($_GET['ID'])){
		//getting the user information
		$id = mysqli_real_escape_string($connection,$_GET['ID'] );
		
			
		$query = "UPDATE contact SET Is_Delete=1 WHERE id ='{$id}' LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if($result){
			//user deleted
			
			   header('Location:viewcontact.php?msg=user-deleted');
		 
			
		}else{
			
		
			   header('Location:viewcontact.php?err=delete_failed');
		    
		}
			
			
		
		
		}else{
		
			   header('Location:viewcontact.php');
		    
	}
	
?>	