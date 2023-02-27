<?php session_start(); ?>
<?php
    
    require_once("inc/connection.php");
    
	
    $user_id=$_SESSION['user_id'];

    if(isset($_POST['submit']))
    {
        if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['number']) || empty($_POST['country']) || empty($_POST['shipname']) || empty($_POST['country'])|| empty($_POST['id'])|| empty($_POST['type']) || empty($_POST['height']) || empty($_POST['width']) || empty($_POST['length']) || empty($_POST['others']) || empty($_FILES['image']['name']))
        {
            echo ' Please Fill in the Blanks ';
        }
        else
        {
			      $upload_to = 'shipimages/';
		          $file_name = $_FILES['image']['name'];
				   $temp_name = $_FILES['image']['tmp_name'];
                     $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
				  
			
			
            $UserName = $_POST['name'];
            $UserEmail = $_POST['email'];
            $PhoneNumber = $_POST['number'];
            $Country = $_POST['country'];
            $ShipName = $_POST['shipname'];
            $ShipRegistrationCountry = $_POST['country'];
            $RegistrationId = $_POST['id'];
            $Type = $_POST['type'];
            $Height = $_POST['height'];
            $Width = $_POST['width'];
            $Length = $_POST['length'];
            $Others = $_POST['others'];
            $ShipImage = $_FILES['image']['name'];
			
			


            $query = " insert into records (User_ID,User_Name,User_Email,Phone_Number,Country,Ship_Name,Ship_Registration_Country,Registration_Id,Type,Height,Width,Length,Others,Ship_Image) values('$user_id','$UserName','$UserEmail','$PhoneNumber','$Country','$ShipName','$ShipRegistrationCountry','$RegistrationId','$Type','$Height','$Width','$Length','$Others','$ShipImage')";
            $result = mysqli_query($connection,$query);

            if($result)
            {
                header("location:user.php");
            }
            else
            {
                echo '  Please Check Your Query ';
            }
        }
    }
    else
    {
        header("location:ship-index.php");
    }



?>