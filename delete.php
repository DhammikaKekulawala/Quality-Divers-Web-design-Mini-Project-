<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	
	
	
	if(isset($_GET['user_id'])){
		//getting the user information
		$user_id = mysqli_real_escape_string($connection,$_GET['user_id'] );
		
		
		//thamange aka account aka delete karanna be
		if($user_id == $_SESSION['user_id']){
			//
			header('Location: users.php?err=cannot_delete_current_user');
		}else{
			//deleting the user
			
		$query = "UPDATE user SET is_delete =1 WHERE id ={$user_id} LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if($result){
			//user deleted
			$query = "SELECT type FROM user WHERE id ={$user_id} LIMIT 1";
		
		   $result = mysqli_query($connection, $query);
		   $user = mysqli_fetch_assoc($result);
		    if( $user['type'] == 1){
			   header('Location:worker_details.php?msg=user-deleted');
		    }else{
			   header('Location:users_details.php?msg=user-deleted');
		    }
			
		}else{
			
			$query = "SELECT type FROM user WHERE id ={$user_id} LIMIT 1";
		
		   $result = mysqli_query($connection, $query);
		   $user = mysqli_fetch_assoc($result);
		    if( $user['type'] == 1){
			   header('Location:worker_details.php?err=delete_failed');
		    }else{
			   header('Location:users_details.php?err=delete_failed');
		    }
		}
			
			
		}
		
		}else{
		
			$query = "SELECT type FROM user WHERE id ={$user_id} LIMIT 1";
		
		   $result = mysqli_query($connection, $query);
		   $user = mysqli_fetch_assoc($result);
		    if( $user['type'] == 1){
			   header('Location:worker_details');
		    }else{
			   header('Location:users_details');
		    }
	}
	
?>	
	
	
	
	