<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	$errors = array();
	$product_id = '';
	$product_name = '';
	$product_prices = '';
	$product_brand = '';
	$description = '';
	$store = '';
	$made_in = '';
	$manufactured_by ='';
	$image = '';
	
	if(isset($_GET['product_id'])){
		//getting the user information
		$product_id = mysqli_real_escape_string($connection,$_GET['product_id'] );
		
		$query="SELECT * FROM product WHERE product_id ={$product_id} LIMIT 1";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$product_name = $result['product_name'];
				$product_id = $result['product_id'];
				$product_prices = $result['product_prices'];
				$product_brand = $result['product_brand'];
				$description = $result['description'];
				$store = $result['store'];
				$made_in = $result['made_in'];
				$manufactured_by = $result['manufactured_by'];
				$image = "<img src='product/".$result['image']. "'>";
			}else{
				//user not found
				header('Location:product.php');
				
			}
		}else{
			// query unsuccessful
			header('Location:product.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		
		  $product_id = $_POST['product_id'];
	      $product_name = $_POST['product_name'];
	      $product_prices = $_POST['product_prices'];
	      $product_brand = $_POST['product_brand'];
	      $description  = $_POST['description'];
	      $store = $_POST['store'];
		  $made_in = $_POST['made_in'];
		  $manufactured_by = $_POST['manufactured_by'];
		
		if(empty(trim($_POST['product_id']))){ 
		 $errors[]='product id is required';
		}
		if(empty(trim($_POST['product_name']))){ 
		 $errors[]='Product name is required';
		}
		if(empty(trim($_POST['product_prices']))){ 
		 $errors[]='Product prices is required';
		}
		if(empty(trim($_POST['product_brand']))){ 
		 $errors[]='Product brand is required';
		}
		if(empty(trim($_POST['description']))){ 
		 $errors[]='Description is required';
		}
		if(empty(trim($_POST['store']))){ 
		 $errors[]='store is required';
		}
		if(empty(trim($_POST['made_in']))){ 
		 $errors[]='Made in is required';
		}
		if(empty(trim($_POST['manufactured_by']))){ 
		 $errors[]='Manufactured by is required';
		}
		
		
		
		
		if(empty($errors)){
			//no errors found... adding new record
			
			$product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
			$product_prices = mysqli_real_escape_string($connection, $_POST['product_prices']);
			$product_brand = mysqli_real_escape_string($connection, $_POST['product_brand']);
			$description = mysqli_real_escape_string($connection, $_POST['description']);
			$store= mysqli_real_escape_string($connection, $_POST['store']);
			$made_in= mysqli_real_escape_string($connection, $_POST['made_in']);
			$manufactured_by= mysqli_real_escape_string($connection, $_POST['manufactured_by']);
		   
		   
		    if(isset($_FILES['image']))
			{
                $file_name = $_FILES['image']['name'];
               $temp_name = $_FILES['image']['tmp_name'];
                //photo direction
		       $upload_to = 'product/';
                $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
                $target = "product/".basename($file_name);
              }
			else
			{
				$file_name = '';
			}
			
			
			
			
			$query = " UPDATE product SET";
			$query .=" product_name='{$product_name}',product_prices='{$product_prices}',product_brand='{$product_brand}',description='{$description}',store='{$store}',made_in='{$made_in}',manufactured_by='{$manufactured_by}'";
			if(!empty($file_name)) $query .= ",image='{$file_name}'";
			$query .="WHERE product_id={$product_id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: product.php?product_modified=true');
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Modify Product</title>
<link rel="stylesheet" href="css/main.css">
<style>
 img{
	 width:350px;
	 height:300px;
 }
</style>
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
  <br>
 <h1>Update Info</h1>
 <br>
 <?php
      if(!empty($errors)){
		 echo'<div class="errmsg">' ;
		 echo'<b>There were errors on your form</br></b>';
        foreach($errors as $error){
			echo $error. '<br>';
		}
      echo'</div>';		
	  }
	  
 
 ?>
 
 <form action="product-modify.php"  method="post" class="userform" enctype="multipart/form-data">
 	<input type ="hidden" name="product_id" value="<?php echo $product_id?>">
   <p>
   <lable for="">Product Name &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="product_name"<?php echo 'value="' . $product_name . '"'; ?>>
   </p>
   <p>
   <lable for="">Product Prices &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="product_prices"<?php echo 'value="' . $product_prices . '"';?>>
   </p>
   <p>
   <lable for="">Product Brand &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="product_brand" <?php echo 'value="' . $product_brand . '"'; ?>>
   </p>
   <p>
   <lable for="">Description &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="description" <?php echo 'value="' . $description . '"';  ?>>
   </p>
    <p>
   <lable for="">Store &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="store" <?php echo 'value="' . $store . '"'; ?>>
   </p>
   <p>
   <lable for="">Made In &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="made_in" <?php echo 'value="' . $made_in . '"';?>>
   </p>
   <p>
   <lable for="">Manufactured By &nbsp : </lable>
   <input type="text" name="manufactured_by" <?php echo 'value="' . $manufactured_by . '"';?>>
   </p>
   <p>
   <lable for="">New Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="file" name="image">
   </p>
    <p>
   <lable for="">Previous Photo &nbsp &nbsp &nbsp: </lable>
   <?php echo " $image ";  //data form akata genima sadaha?>
   </p>
    <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">Save</button>
   </p>
   <br>
   <div class="backto"><span><a href="product.php"> Back </a></span></div>
 
 </form>
 </main>
</body>

</html>