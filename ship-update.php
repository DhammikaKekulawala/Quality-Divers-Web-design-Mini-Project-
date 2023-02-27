<?php session_start(); ?>

<?php 

    require_once("inc/connection.php");

    if(isset($_POST['update']))
    {
		$upload_to = 'shipimages/';
		          $file_name = $_FILES['image']['name'];
				   $temp_name = $_FILES['image']['tmp_name'];
                     $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
		
		
        $UserID =  mysqli_real_escape_string($connection,$_POST['UserID']);
        $UserName = mysqli_real_escape_string($connection,$_POST['name']);
        $UserEmail = mysqli_real_escape_string($connection, $_POST['email']);
        $PhoneNumber = mysqli_real_escape_string($connection,$_POST['number']);
        $Country = mysqli_real_escape_string($connection,$_POST['country']);
        $ShipName = mysqli_real_escape_string($connection,$_POST['name']);
        $ShipRegistrationCountry = mysqli_real_escape_string($connection, $_POST['country']);
        $RegistrationId = mysqli_real_escape_string($connection,$_POST['id']);     
        $Type = mysqli_real_escape_string($connection,$_POST['type']);
        $Height = mysqli_real_escape_string($connection,$_POST['height']);
        $Width = mysqli_real_escape_string($connection,$_POST['width']);
        $Length = mysqli_real_escape_string($connection,$_POST['length']);
        $Others = mysqli_real_escape_string($connection,$_POST['others']);
	    
       

        $query = "UPDATE records SET User_Name ='{$UserName}',User_Email='{$UserEmail}',Phone_Number ='{$PhoneNumber}',Country ='{$Country}',Ship_Name ='{$ShipName}',Ship_Registration_Country ='{$ShipRegistrationCountry}',Registration_Id ='{$RegistrationId}',Type='{$Type}',Height='{$Height}',Width='{$Width}',Length='{$Length}',Others ='{$Others}',Ship_Image ='{$file_name}' WHERE User_ID='{$UserID}'  LIMIT 1";
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
        header("location:ship-view.php");
    }


?>