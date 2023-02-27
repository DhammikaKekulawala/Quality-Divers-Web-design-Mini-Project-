<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php

if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

	$errors = array();
  $mag = array();

   if (isset($_POST['submit'])) {
		// submitt button is clicked
        

        //file kiyana super golable  variable ake thibba awa
		
    
    if (empty($errors)) {
      //file akak  upload karana aka
      //$file_uploaded = move_uploaded_file($temp_name, $file_name);
      $mag[] = 'Seccessful your photo upload.';
    }
  }


	
  
  if(isset($_POST['submit'])){
    //checking required field
    //trim space aen karanna
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];

    $upload_to = 'product';

    // checking the file type
    if ($file_type != 'image/jpeg') {
      $errors[] = 'Only JPEG files are allowed.';
    }

    // checking file size
    if ($file_size > 500000) {
      $errors[] = 'File size should be less than 500kb.';
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
     $errors[]='description is required';
    }
    if(empty(trim($_POST['store']))){ 
     $errors[]='Store is required';
    }
    if(empty(trim($_POST['made_in']))){ 
     $errors[]='Made in is required';
    }
	if(empty(trim($_POST['manufactured_by']))){ 
     $errors[]='Manufactured by is required';
    }
    
    //photo direction
    $upload_to = 'product/';
    $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    
    if(empty($errors)){
      //no errors found... adding new record
      $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
      $product_prices = mysqli_real_escape_string($connection, $_POST['product_prices']);
      $product_brand = mysqli_real_escape_string($connection, $_POST['product_brand']);
      $description = mysqli_real_escape_string($connection, $_POST['description']);
      $store = mysqli_real_escape_string($connection, $_POST['store']);
      $made_in = mysqli_real_escape_string($connection, $_POST['made_in']);
	  $manufactured_by = mysqli_real_escape_string($connection, $_POST['manufactured_by']);
      $file_name = $_FILES['image']['name'];
      $target = "product/".basename($file_name);

     
      
      $query = "INSERT INTO product (";
      $query .="product_name,product_prices,product_brand,description,store,made_in,manufactured_by,is_deleted,image";
      $query .=") VALUES(";
      $query .="'{$product_name}','{$product_prices}','{$product_brand}','{$description}','{$store}','{$made_in}','{$manufactured_by}',0,'{$file_name}'";
      $query .=")";
      
      
	  
	  
      $result = mysqli_query($connection,$query);
      
      if($result){
        //query sucessful... redirecting to users page
        header('Location: product.php?product_addded correct');
        
      }else{
        $errors[] ='Failed to add the new record';
      }
      
    }
    
  }

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
  <a href="logout.php"> Log Out </a></div> 
  </header>
  
  <main>
 
 <?php
      if(!empty($errors)){
		 echo'<div class="errmsg">' ;
		 echo'<b>There were errors on your form</br></b>';
        foreach($errors as $error){
			echo $error. '<br>';
		}
      echo'</div>';		
	  }
	   
      if(!empty($mag)){
     echo'<div class="errmsg">' ;
        foreach($errors as $error){
      echo $error. '<br>';
    }
      echo'</div>';   
    }
    
 
 ?>
 
 <form action="product-add.php"  method="post" class="userform" enctype="multipart/form-data">
    
      <h1>Add New Product</h1>
    
	<br>
   <p><lable for="">Product Name &nbsp &nbsp :</lable>
   <input type="text" name="product_name">
   </p>
    <tr>
   <p><lable for="">Product Prices &nbsp &nbsp :</lable>
   <input type="text" name="product_prices" >
   </p>
   <p>
   <lable for="">Product Brand &nbsp &nbsp :</lable>
   <input type="text" name="product_brand">
   </p>
    <p>
   <lable for="">Description &nbsp &nbsp &nbsp &nbsp &nbsp:</lable>
   <input type="text" name="description">
   </p>
   <p>
   <lable for="">Store &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="store">
   </p>
   <p>
   <lable for="">Made In &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:</lable>
   <input type="text" name="made_in">
   </p>
   <p>
   <lable for="">Manufactured By:</lable>
   <input type="text" name="manufactured_by">
   </p>
   <p>
   <lable for="">Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:</lable>
   <input type="file" name="image" id="">
   </p>
	 
   
   <?php 
		 //upload karana file aka gena
			if (isset($file_uploaded)) {
				echo '<p>Uploaded image ';
				echo '<img src="' .  $file_name . '" style="height:200px  </p>">';
			}

		 ?>
   <p>
   <lable for="">&nbsp </lable>
   <button type="submit" name="submit">Save</button>
   </p>
   <br>
   <div class="backto"><span><a href="product.php"> Back </a></span></div>
    
   
 
 </form>
 </main>
</body>

</html>