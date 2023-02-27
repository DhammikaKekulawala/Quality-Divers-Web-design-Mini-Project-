<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	
	
	
	if(isset($_GET['id'])){
		//getting the user information
		$id = mysqli_real_escape_string($connection,$_GET['id'] );
		
			
		$query = "DELETE FROM comment  WHERE id ={$id} LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if($result){
			//user deleted
			
			   header('Location:product-comment.php?msg=user-deleted');
		 
			
		}else{
			
		
			   header('Location:product-comment.php?err=delete_failed');
		    
		}
			
			
		
		
		}else{
		
			   header('Location:product-comment.php');
		    
	}
	
?>	