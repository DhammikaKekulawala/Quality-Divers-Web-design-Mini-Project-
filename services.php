<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Services Form</title>
	<link href = "form.css" rel = "stylesheet">
	
	<style>
	body{
		background-image: url(1.jpg);
	}
	header{
		color:black;
	}
	.servicesform-min{
	display:none;
   }	
   .main-min{
	  display:none;
      padding:0px;	  
   }
	@media screen and (max-width: 800px) {
	.main {display: none;  }	
	.servicesform {display: none;  }
	.servicesform-min{ display:block;}
	.main-min { display:block;}
    .firstname{left:0px;}
    .lastname{left:0px;  } 
    .company{left:0px;}
    .ship-name{left:0px;}	
	.ship-id{ left:0px;}
	.length{left:0px;}
	.width{left:0px;}
	.height{left:0px;}
	.country{left:0px;}
	.email{left:0px;  }     
    .Code{left:0px;}
	.number{left:0px;}
	.area-code{left:0px;}
	.group { margin-left: 0px;}
	.other{left: 0px;}
   }
   @media screen and (max-width: 550px) {
	.main {display: none;  }	
	.servicesform {display: none;  }
	.servicesform-min{ display:block;}
	.main-min { display:block;}
    .firstname{left:0px; width:98%;}
    .lastname{left:0px;  width:98%; } 
    .company{left:0px; width:98%;}
    .ship-name{left:0px; width:98%;}	
	.ship-id{ left:0px; width:98%; padding-left:1%;}
	.length{left:0px; width:98%;}
	.width{left:0px; width:98%;}
	.height{left:0px; width:98%; }
	.country{left:0px; width:98%;}
	.email{left:0px;  width:98%; }     
    .Code{left:0px; width:98%;}
	.number{left:0px; width:98%;}
	.area-code{left:0px; width:98%;}
	.group { margin-left: 0px;}
	.other{left: 0px; width:98%;}
   }
   .servicesform-min{
	width: 80%;
	margin:auto;
	padding: 10px 0px 10px 0px;
	text-align: center;
	border-radius: 15px 15px 0px 0px ;
	}
	
	
	</style>
</head>

<body>

<header>
    <div class="appname"><a href="user.php">User panal </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <br>
  <br>
    <div class="servicesform">
        <h1>Services Form </h1>
	</div>

	<div class="main">
        <form action = "data.php" method="POST">
         
                <h2 class = "name">Name </h2>
					<input class = "firstname" type = "text" name = "first_name" placeholder = "First Name" required>
					<input class = "lastname" type = "text" name = "last_name" placeholder = "Last Name" required>
			
				<h2 class = "name">Company Name </h2>
					<input class = "company" type = "text" name = "company" placeholder = "Company Name" required>
				
				<h2 class = "name">Ship Name </h2>
					<input class = "ship-name" type = "text" name = "ship_name" placeholder = "Ship Name" required>
				
				<h2 class = "name">Ship ID </h2>
					<input class = "ship-id" type = "text" name = "ship_id" placeholder = "Ship ID" required>
				
				<h2 class = "name">Ship Dimensions</h2>
					<input class = "length" type = "text" name = "length" placeholder = "Length in meters" required>
					<input class = "width" type = "text" name = "width" placeholder = "Width in meters" required>
					<input class = "height" type = "text" name = "height" placeholder = "Height in meters" required>
				
				<h2 class = "name">Country </h2>
					<input class = "country" type = "text" name = "country" placeholder = "Country">
				
				<h2 class = "name">E-mail</h2>
					<input class = "email" type = "email" name = "email" placeholder = "E-mail" required>
				
				<h2 class = "name">Phone</h2>
					<input class = "Code" type = "text" name = "area_code" placeholder = "Area-Code" required>
					
					<input class = "number" type = "text" name = "phone" placeholder = "Phone No." required>
					
				<h2 style="text-align:center">Services</h2><br>

					<h2 style="margin-left:100px">Under Water Services</h2><br>

						<div class = "group">
							<input type = "checkbox" id = "s1" name="Under_Water[]" value = "Salvage & Towage of Ships">
							<label for = "s1">Salvage & Towage of Ships</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s2" name="Under_Water[]" value = "Ultrasonic gauging of plate thickness">
							<label for = "s2">Ultrasonic gauging of plate thickness</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s3" name="Under_Water[]" value = "Deep diving work for Hydro Power Dams">
							<label for = "s3">Deep diving work for Hydro Power Dams</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s4" name="Under_Water[]" value = "Rock Blasting">
							<label for = "s4">Rock Blasting</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s5" name="Under_Water[]" value = "Propeller Polishing">
							<label for = "s5">Propeller Polishing</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s6" name="Under_Water[]" value = "Laying and Recovery of Oceanographic Instruments">
							<label for = "s6">Laying and Recovery of Oceanographic Instruments</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s7" name="Under_Water[]" value = "Cable Laying">
							<label for = "s7">Cable Laying</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s8" name="Under_Water[]" value = "Pipe lining & Inspection">
							<label for = "s8">Pipe lining & Inspection</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s9" name="Under_Water[]" value = "Underwater Video Filming & Monitoring">
							<label for = "s9">Underwater Video Filming & Monitoring</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s10" name="Under_Water[]" value = "In Water Surveys of Ships">
							<label for = "s10">In Water Surveys of Ships</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s11" name="Under_Water[]" value = "Underwater Welding & Cutting">
							<label for = "s11">Underwater Welding & Cutting</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s12" name="Under_Water[]" value = "Hull cleaning Services">
							<label for = "s12">Hull cleaning Services</label>
						</div><br><br>

					<h2 style="margin-left:100px">Above Water Services</h2><br>

						<div class = "group">
							<input type = "checkbox" id = "s13" name="Above_Water[]" value = "Supply of fresh water to ships in & outside the harbor">
							<label for = "s13">Supply of fresh water to ships in & outside the harbor</label>
						</div>
						
						<div class = "group">
							<input type = "checkbox" id = "s14" name="Above_Water[]" value = "Providing Supply Boats">
							<label for = "s14">Providing Supply Boats</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s15" name="Above_Water[]" value = "Ship to shore transport for crew">
							<label for = "s15">Ship to shore transport for crew</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s16" name="Above_Water[]" value = "Construction & Maintenance of Marine Structures">
							<label for = "s16">Construction & Maintenance of Marine Structures</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s17" name="Above_Water[]" value = "Hull & Machinery repairs. (Floating Workshop)">
							<label for = "s17">Hull & Machinery repairs. (Floating Workshop)</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s18" name="Above_Water[]" value = "Transportation of material and equipment outside">
							<label for = "s18">Transportation of material and equipment outside</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s19" name="Above_Water[]" value = "Ship Repairs">
							<label for = "s19">Ship Repairs</label>
						</div><br>
						
						<div class = "name">Other Details
							<textarea class = "other" type = "text" name = "other" placeholder = "Other Details" rows="4" cols = "80" ></textarea>
						</div>
		
				<button type="submit"><b>Confirm</b></button>
				<button type="reset"><b>Reset</b></button>
        </form>
	</div>


<div class="servicesform-min">
        <h1>Services Form </h1>
	</div><br><br><br>

	<div class="main-min">
        <form action = "data.php" method="POST">
         
                <br>
					<input class = "firstname" type = "text" name = "first_name" placeholder = "First Name" required>
					<input class = "lastname" type = "text" name = "last_name" placeholder = "Last Name" required><br>
			
				<br>
				<br>
					<input class = "company" type = "text" name = "company" placeholder = "Company Name" required>
				
				<br><br><br>
					<input class = "ship-name" type = "text" name = "ship_name" placeholder = "Ship Name" required>
				
				<br><br><br>
					<input class = "ship-id" type = "text" name = "ship_id" placeholder = "Ship ID" required>
				
				<br><br><br>
					<input class = "length" type = "text" name = "length" placeholder = "Length in meters" required>
					<input class = "width" type = "text" name = "width" placeholder = "Width in meters" required>
					<input class = "height" type = "text" name = "height" placeholder = "Height in meters" required>
				
				<br><br><br>
					<input class = "country" type = "text" name = "country" placeholder = "Country">
				
				<br><br><br>
					<input class = "email" type = "email" name = "email" placeholder = "E-mail" required>
				
				<br><br><br>
					<input class = "Code" type = "text" name = "area_code" placeholder = "Area-Code" required>
					
					<input class = "number" type = "text" name = "phone" placeholder = "Phone No." required>
					
				<h2 style="margin-left:150px">Services</h2><br>

					<h2 style="margin-left:100px">Under Water Services</h2><br>

						<div class = "group">
							<input type = "checkbox" id = "s1" name="Under_Water[]" value = "Salvage & Towage of Ships">
							<label for = "s1">Salvage & Towage of Ships</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s2" name="Under_Water[]" value = "Ultrasonic gauging of plate thickness">
							<label for = "s2">Ultrasonic gauging of plate thickness</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s3" name="Under_Water[]" value = "Deep diving work for Hydro Power Dams">
							<label for = "s3">Deep diving work for Hydro Power Dams</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s4" name="Under_Water[]" value = "Rock Blasting">
							<label for = "s4">Rock Blasting</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s5" name="Under_Water[]" value = "Propeller Polishing">
							<label for = "s5">Propeller Polishing</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s6" name="Under_Water[]" value = "Laying and Recovery of Oceanographic Instruments">
							<label for = "s6">Laying and Recovery of Oceanographic Instruments</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s7" name="Under_Water[]" value = "Cable Laying">
							<label for = "s7">Cable Laying</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s8" name="Under_Water[]" value = "Pipe lining & Inspection">
							<label for = "s8">Pipe lining & Inspection</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s9" name="Under_Water[]" value = "Underwater Video Filming & Monitoring">
							<label for = "s9">Underwater Video Filming & Monitoring</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s10" name="Under_Water[]" value = "In Water Surveys of Ships">
							<label for = "s10">In Water Surveys of Ships</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s11" name="Under_Water[]" value = "Underwater Welding & Cutting">
							<label for = "s11">Underwater Welding & Cutting</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s12" name="Under_Water[]" value = "Hull cleaning Services">
							<label for = "s12">Hull cleaning Services</label>
						</div><br><br>

					<h2 style="margin-left:100px">Above Water Services</h2><br>

						<div class = "group">
							<input type = "checkbox" id = "s13" name="Above_Water[]" value = "Supply of fresh water to ships in & outside the harbor">
							<label for = "s13">Supply of fresh water to ships in & outside the harbor</label>
						</div>
						
						<div class = "group">
							<input type = "checkbox" id = "s14" name="Above_Water[]" value = "Providing Supply Boats">
							<label for = "s14">Providing Supply Boats</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s15" name="Above_Water[]" value = "Ship to shore transport for crew">
							<label for = "s15">Ship to shore transport for crew</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s16" name="Above_Water[]" value = "Construction & Maintenance of Marine Structures">
							<label for = "s16">Construction & Maintenance of Marine Structures</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s17" name="Above_Water[]" value = "Hull & Machinery repairs. (Floating Workshop)">
							<label for = "s17">Hull & Machinery repairs. (Floating Workshop)</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s18" name="Above_Water[]" value = "Transportation of material and equipment outside">
							<label for = "s18">Transportation of material and equipment outside</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s19" name="Above_Water[]" value = "Ship Repairs">
							<label for = "s19">Ship Repairs</label>
						</div><br>
						
						<br><br><br>
							<textarea class = "other" type = "text" name = "other" placeholder = "Other Details" rows="4" cols = "80" ></textarea>
						
		
				<button type="submit"><b>Confirm</b></button>
				<button type="reset"><b>Reset</b></button>
        </form>
	</div>
</body>
</html>