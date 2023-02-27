<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
 
   
  
<!DOCTYPE html>
<html> 
<head>
<title>Log In -User Management System</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<section class="section-default">
      <?php 
        $selector = $_GET["selector"];
        $selector = $_GET["validator"];

         if(empty($selector)|| empty($validator)){
            echo "Could not validate your request!";
         }else{
            if(ctype_xdigitor($selector)!== false && ctype_xdigit($validator) !== false){
               ?>
               <form action="includes-resert-password.inc.php"method="post">

                 <input type="hidden" name="selector" value="<?php echo $selector ?>">
                 <input type="hidden" name="selector" value="<?php echo $validator ?>">
                 <input type="password" name="pwd" value=""placeholder="Enter new password">
                 <input type="password" name="pwd-repeat" value=""placeholder="Repeat new password">
                 <button type="submit" name="reset-password-submit">Reset password</button>
               </form>
               <?php
            }
         }

      ?>

    </section>

</body>

</html>
<?php mysqli_close($connection); ?>