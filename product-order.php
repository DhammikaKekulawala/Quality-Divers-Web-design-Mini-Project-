<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php

if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

 $user_id=$_SESSION['user_id'];
	$errors = array();
  $mag = array();

   //print_r($_POST);
   //die();

  if(isset($_POST['submit'])){
	 $total=0;
	  $n1= !empty($_POST['n1'])?$_POST['n1']:0;
	  $n2= !empty($_POST['n2'])?$_POST['n2']:0;
	  $n3= !empty($_POST['n3'])?$_POST['n3']:0;
	  $n4= !empty($_POST['n4'])?$_POST['n4']:0;
	  $n5= !empty($_POST['n5'])?$_POST['n5']:0;
	  $n6= !empty($_POST['n6'])?$_POST['n6']:0;
	  $n7= !empty($_POST['n7'])?$_POST['n7']:0;
	  $n8= !empty($_POST['n8'])?$_POST['n8']:0;
	  $n9= !empty($_POST['n9'])?$_POST['n9']:0;
	  $n10= !empty($_POST['n10'])?$_POST['n10']:0;
	  $n11= !empty($_POST['n11'])?$_POST['n11']:0;
	  $n12= !empty($_POST['n12'])?$_POST['n12']:0;
	  
	  
	 $total=$n1+$n2+$n3+$n4+$n5+$n6+$n7+$n8+$n9+$n10+$n11+$n12;
	 echo $total;
	 
	 if(empty($errors)){
			//no errors found... adding new record
			echo $total;
			$boat_towed_meta = mysqli_real_escape_string($connection, $_POST['boat_towed_meta']);
			$accessories = mysqli_real_escape_string($connection, $_POST['accessories']);
			$brush_kart = mysqli_real_escape_string($connection, $_POST['brush_kart']);
			$hand_held_metal = mysqli_real_escape_string($connection, $_POST['hand_held_metal']);
			$hydraulic_power = mysqli_real_escape_string($connection, $_POST['hydraulic_power']);
			$mini_brush_kart = mysqli_real_escape_string($connection, $_POST['mini_brush_kart']);
			$pali_bilgeSafe = mysqli_real_escape_string($connection, $_POST['pali_bilgeSafe']);
			$pingers_and_pin = mysqli_real_escape_string($connection, $_POST['pingers_and_pin']);
			$portable_cabin = mysqli_real_escape_string($connection, $_POST['portable_cabin']);
			$remote_operated = mysqli_real_escape_string($connection, $_POST['remote_operated']);
			$sonar_systems = mysqli_real_escape_string($connection, $_POST['sonar_systems']);
			$underwater_came = mysqli_real_escape_string($connection, $_POST['underwater_came']);
			$total = mysqli_real_escape_string($connection, $total );
			
			
			
			 $query = "INSERT INTO orders (";
             $query .="user_id,boat_towed_meta,accessories,brush_kart,hand_held_metal,hydraulic_power,mini_brush_kart,pali_bilgeSafe,pingers_and_pin,protable_cabin,remote_operated,sonar_systems,underwate_came,total_prices,is_deleted";
             $query .=") VALUES(";
             $query .="'{$user_id}','{$boat_towed_meta}','{$accessories}','{$brush_kart}','{$hand_held_metal}','{$hydraulic_power}','{$mini_brush_kart}','{$pali_bilgeSafe}','{$pingers_and_pin}','{$portable_cabin}','{$remote_operated}','{$sonar_systems}','{$underwater_came}','{$total}',0";
             $query .=")";
      
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location:pay.php?total='.$total);
				echo $total;
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
	 }
  }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Add users</title>
<link rel="stylesheet" href="css/user.css">
<style>
form{
	width:1000px;
}
input{
	width:200px;
	font-size:20px;
}
header{
	background-color: yellow;
	overflow: auto;
	padding: 10px;
	color:black;
	margin-top:0px;
	margin-right:0px;
	margin-right:0px;
}
 header .appname{
	 float: left;
	 background-color: yellow;
}
header .loggedin{
	float: right;
	 background-color: yellow;

}
.table1{
	width:40px;
	
}
button{
	width:100px;
	height:30px;
	color:white;
	background-color:red;
}
img{
	height:175px;
	width:200px;
}
table{
	background-color:white;
	padding:10px;
}
.minorder{
	display:none;
}
@media screen and (max-width: 1050px) {
	main {margin:0px;}
}
@media screen and (max-width: 900px) {
	main {display: none }
	.minorder{ display: block }
	.minorder table{ margin-left:10%; }
}
@media screen and (max-width: 600px) {
	main {display: none }
	.minorder{ display: block }
	.minorder table{ margin-left:0px; }
	.minorder img{ width:125px; height:100px; }
	.minorder button{ margin-left:0px;  }
}


</style>
<script>
      function mult(value){
		  var x ;
		  x= 30000 * value ;
		  
		  document.getElementById('u1').value = x;
	  }
	  function mult1(value){
		  var x ;
		  x= 76900 * value ;
		  
		  document.getElementById('u2').value = x;
	  }
	  function mult2(value){
		  var x ;
		  x= 50000 * value ;
		  
		  document.getElementById('u3').value = x;
	  }
	  function mult3(value){
		  var x ;
		  x= 35999 * value ;
		  
		  document.getElementById('u4').value = x;
	  }
	  function mult4(value){
		  var x ;
		  x= 10000 * value ;
		  
		  document.getElementById('u5').value = x;
	  }
	   function mult5(value){
		  var x ;
		  x= 30000 * value ;
		  
		  document.getElementById('u6').value = x;
	  }
	  function mult6(value){
		  var x ;
		  x= 49999 * value ;
		  
		  document.getElementById('u7').value = x;
	  }
	  function mult7(value){
		  var x ;
		  x= 21000 * value ;
		  
		  document.getElementById('u8').value = x;
	  }
	   function mult8(value){
		  var x ;
		  x= 21999 * value ;
		  
		  document.getElementById('u9').value = x;
	  }
	   function mult9(value){
		  var x ;
		  x= 123455 * value ;
		  
		  document.getElementById('u10').value = x;
	  }
	  function mult10(value){
		  var x ;
		  x= 20000 * value ;
		  
		  document.getElementById('u11').value = x;
	  }function mult11(value){
		  var x ;
		  x= 29000 * value ;
		  
		  document.getElementById('u12').value = x;
	  }
	  function calculate(){
		  var n1=document.getElementById('u1').value;
		   var n2=document.getElementById('u2').value;
		   
		   var result=parseFloat(n1)+parseFloat(n2);
		   
		   
			   document.getElementById('u13').value = result ;
		   
	  }
	  function mult13(value){
		  var x ;
		  x= 30000 * value ;
		  
		  document.getElementById('u13').value = x;
	  }
	  function mult14(value){
		  var x ;
		  x= 76900 * value ;
		  
		  document.getElementById('u14').value = x;
	  }
	  function mult15(value){
		  var x ;
		  x= 50000 * value ;
		  
		  document.getElementById('u15').value = x;
	  }
	  function mult16(value){
		  var x ;
		  x= 35999 * value ;
		  
		  document.getElementById('u16').value = x;
	  }
	  function mult17(value){
		  var x ;
		  x= 10000 * value ;
		  
		  document.getElementById('u17').value = x;
	  }
	   function mult18(value){
		  var x ;
		  x= 30000 * value ;
		  
		  document.getElementById('u18').value = x;
	  }
	  function mult19(value){
		  var x ;
		  x= 49999 * value ;
		  
		  document.getElementById('u19').value = x;
	  }
	  function mult20(value){
		  var x ;
		  x= 21000 * value ;
		  
		  document.getElementById('u20').value = x;
	  }
	   function mult21(value){
		  var x ;
		  x= 21999 * value ;
		  
		  document.getElementById('u21').value = x;
	  }
	   function mult22(value){
		  var x ;
		  x= 123455 * value ;
		  
		  document.getElementById('u22').value = x;
	  }
	  function mult23(value){
		  var x ;
		  x= 20000 * value ;
		  
		  document.getElementById('u23').value = x;
	  }function mult24(value){
		  var x ;
		  x= 29000 * value ;
		  
		  document.getElementById('u24').value = x;
	  }
	  
</script>
</head>
<body>
  <header>
    <div class="appname"><a href="user.php">User panal </a></div>
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
 <br>
 
 <form action="product-order.php"  method="post" class="userform" >
    
   <h1>Add Order</h1>
   <br>
   <br>
    <table>
	<tr>
	<th>Product</th>
	<th>Product Name</th>
	<th>Order</th>
	<th>Prices</th>
	<th>Amount</th>
	</tr>
	<tr><td><br></td></tr>
   <tr><td><img src="product/OIP (6).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Accessories:</lable></td>
   <td><input type="text" name="accessories" class="table1" value="5"  onkeyup="mult(this.value) ; "></td>
   <td> $30000</td>
   <td><input type="text" id="u1" name="n1" ></td></tr>
    <tr>
   <td><img src="product/OIP (1).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Boat Towed Meta:</lable></td>
   <td><input type="text" name="boat_towed_meta"  class="table1" onkeyup="mult1(this.value);" > </td>
  <td> $76900</td>
  <td><input type="text" id="u2" name="n2"></td></tr>
   <tr>
    <td><img src="product/brush-kart.jpg" alt="Italian Trulli"></td>
   <td><lable for=""> &nbsp BRUSH-KART:</lable></td>
   <td><input type="text" name="brush_kart" class="table1" onkeyup="mult2(this.value);"></td>
    <td> $50000</td>
	<td><input type="text" id="u3" name="n3"></td></tr>
   </tr>
    <tr>
	<td><img src="product/OIP.jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Hand Held Metal:</lable></td>
   <td><input type="text" name="hand_held_metal" class="table1" onkeyup="mult3(this.value);"></td>
  <td>$35999</td>
  <td><input type="text" id="u4" name="n4"></td>
   </tr>
    <tr>
	<td><img src="product/hydraulic-power-1.jpg" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp HYDRAULIC POWER:</lable></td>
   <td><input type="text" name="hydraulic_power" class="table1" onkeyup="mult4(this.value);"></td>
   <td>$10000</td>
   <td><input type="text" id="u5" name="n5"></td>
   </tr>
    <tr>
	<td><img src="product/mini-brush-kart.jpg" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp MINI BRUSH KART:</lable></td>
   <td><input type="text" name="mini_brush_kart" class="table1" onkeyup="mult5(this.value);"></td>
    <td> $30000</td>
	<td><input type="text" id="u6" name="n6"></td>
   </tr>
    <tr>
	<td><img src="product/12960282_1500.19062018020010.jpg" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Pali BilgeSafe:</lable></td>
   <td><input type="text" name="pali_bilgeSafe" class="table1" onkeyup="mult6(this.value);"></td>
    <td> $49999</td>
	<td><input type="text" id="u7" name="n7"></td>
   </tr>
    <tr>
	<td><img src="product/OIP (5).jfif" alt="Italian Trulli"></td>
    <td><lable for="">&nbsp Pingers and Pin:</lable></td>
   <td><input type="text" name="pingers_and_pin" class="table1" onkeyup="mult7(this.value);"></td>
     <td>$21000</td>
	 <td><input type="text" id="u8" name="n8"></td>
   </tr>
   <tr>
   <td><img src="product/7867500.jpg" alt="Italian Trulli"></td>
    <td><lable for="">&nbsp Portable Cabin:</lable></td>
   <td><input type="text" name="portable_cabin" class="table1" onkeyup="mult8(this.value);"></td>
   <td>$21999</td>
   <td><input type="text" id="u9" name="n9"></td>
   </tr>
   <tr>
   <td><img src="product/OIP (2).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Remote Operated:</lable></td>
   <td><input type="text" name="remote_operated" class="table1" onkeyup="mult9(this.value);"></td>
    <td>$123455</td>
	<td><input type="text" id="u10" name="n10"></td>
   </tr>
   <tr>
   <td><img src="product/OIP (4).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Sonar Systems:</lable></td>
   <td><input type="text" name="sonar_systems" class="table1" onkeyup="mult10(this.value);"></td>
    <td>$20000</td>
	<td><input type="text" id="u11" name="n11"></td>
   </tr>
   <tr>
   <td><img src="product/OIP (3).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Underwater Cam:</lable></td>
   <td><input type="text" name="underwater_came" id="" class="table1" onkeyup="mult11(this.value);"></td>
   <td>$29000 </td>
   <td><input type="text" id="u12" name="n12"></td>
   </tr>
    <tr>
   <td><br></td>
   </tr>
   <td><lable for="">&nbsp</lable></td>
   <td><lable for="">&nbsp</lable></td>
   
   <td><button type="submit" name="submit">confrom</button></td>
   </tr>
   
   
    
   </table>
 
 
 </main>
 </form>
 <form action="product-order.php"  method="post" class="userform" >
 <div class="minorder">
   
   
   
    
  
   <br>
   <br>
    <table>
	<tr><big><th colspan="2">Add Order</th></big></tr>
	<tr><td><br></td></tr>
	<tr><td><br></td></tr>
   <tr><td rowspan="4"><img src="product/OIP (6).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Accessories:</lable></td></tr>
   <tr><td> &nbsp $30000</td> </tr>
   <tr><td>&nbsp Order &nbsp <input type="text" name="accessories" class="table1"  onkeyup="mult13(this.value) ; "></td></tr>
   <tr><td><input type="text" id="u13" name="n1" ></td></tr>
   <tr><td><br></td></tr>
   <tr><td><br></td></tr>
    <tr>
   <td rowspan="4"><img src="product/OIP (1).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Boat Towed Meta:</lable></td></tr>
   <tr><td> &nbsp $76900</td></tr>
   <tr><td>&nbsp Order &nbsp <input type="text" name="boat_towed_meta"  class="table1" onkeyup="mult14(this.value);" > </td></tr>
   <tr><td><input type="text" id="u14" name="n2" ></td></tr>
  <tr><td><br></td></tr>
  <tr><td><br></td></tr>
   <tr>
    <td rowspan="4"><img src="product/brush-kart.jpg" alt="Italian Trulli"></td>
   <td><lable for=""> &nbsp BRUSH-KART:</lable></td></tr>
   <tr><td>  &nbsp $50000</td></tr>
   <tr><td>&nbsp Order &nbsp <input type="text" name="brush_kart" class="table1" onkeyup="mult15(this.value);"></td></tr>
   <tr><td><input type="text" id="u15" name="n3" ></td></tr>
	<tr><td><br></td></tr>
   </tr>
    <tr>
	<td rowspan="4"><img src="product/OIP.jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Hand Held Metal:</lable></td></tr>
   <tr><td>&nbsp $35999</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="hand_held_metal" class="table1" onkeyup="mult16(this.value);"></td></tr>
   <tr><td><input type="text" id="u16" name="n4" ></td></tr>
  <tr><td><br></td></tr>
    <tr>
	<td rowspan="4"><img src="product/hydraulic-power-1.jpg" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp HYDRAULIC POWER:</lable></td></tr>
    <tr><td> &nbsp $10000</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="hydraulic_power" class="table1" onkeyup="mult17(this.value);"></td></tr>
   <tr><td><input type="text" id="u17" name="n5" ></td></tr>
   <tr><td><br></td></tr>
    <tr>
	<td rowspan="4"><img src="product/mini-brush-kart.jpg" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp MINI BRUSH KART:</lable></td></tr>
   <tr><td> &nbsp $30000</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="mini_brush_kart" class="table1" onkeyup="mult18(this.value);"></td></tr>
   <tr><td><input type="text" id="u18" name="n6" ></td></tr>
	<tr><td><br></td>
   </tr>
    <tr>
	<td rowspan="4"><img src="product/12960282_1500.19062018020010.jpg" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Pali BilgeSafe:</lable></td></tr>
   <tr><td> &nbsp  $49999</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="pali_bilgeSafe" class="table1" onkeyup="mult19(this.value);"></td></tr>
   <tr><td><input type="text" id="u19" name="n7" ></td></tr>
   <tr><td><br></td></tr>
    <tr>
	<td rowspan="4"><img src="product/OIP (5).jfif" alt="Italian Trulli"></td>
    <td><lable for="">&nbsp Pingers and Pin:</lable></td></tr>
	<tr><td> &nbsp  $21000</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="pingers_and_pin" class="table1" onkeyup="mult20(this.value);"></td></tr> 
  <tr><td><input type="text" id="u20" name="n8" ></td></tr>   
   <tr><td><br></td></tr>
   <tr>
   <td rowspan="4"><img src="product/7867500.jpg" alt="Italian Trulli"></td>
    <td><lable for="">&nbsp Portable Cabin:</lable></td></tr>
	<tr><td> &nbsp $21999</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="portable_cabin" class="table1" onkeyup="mult21(this.value);"></td></tr> 
 <tr><td><input type="text" id="u21" name="n9" ></td></tr>   
   <tr><td><br></td></tr>
   <tr>
   <td rowspan="4"><img src="product/OIP (2).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Remote Operated:</lable></td></tr>
   <tr> <td> &nbsp  $123455</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="remote_operated" class="table1" onkeyup="mult22(this.value);"></td></tr>
   <tr><td><input type="text" id="u22" name="n10" ></td></tr>
   <tr><td><br></td></tr>
   <tr>
   <td rowspan="4"><img src="product/OIP (4).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Sonar Systems:</lable></td></tr>
   <tr> <td> &nbsp $20000</td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="sonar_systems" class="table1" onkeyup="mult23(this.value);"></td></tr>
   <tr><td><input type="text" id="u23" name="n11" ></td></tr>
   <tr><td><br></td></tr>
   <tr>
   <td rowspan="4"><img src="product/OIP (3).jfif" alt="Italian Trulli"></td>
   <td><lable for="">&nbsp Underwater Cam:</lable></td></tr>
   <tr><td> &nbsp $29000 </td></tr>
   <tr><td> &nbsp Order &nbsp <input type="text" name="underwater_came" id="" class="table1" onkeyup="mult24(this.value);"></td></tr>
   <tr><td><input type="text" id="u24" name="n12" ></td></tr>
   <tr><td><br></td></tr>
   </tr>
   <tr><td><br></td></tr>
    <tr>
   <td><br></td>
   </tr>
   
   <td><button type="submit" name="submit">Confrom</button></td>
   </tr>
   
   
    
   </table>
 
 </form>
 
 </div>
 
</body>

</html>