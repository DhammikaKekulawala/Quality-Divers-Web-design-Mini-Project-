<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<link rel="stylesheet" href="css/contactus.css">
</head>

<body>

<div class="headerr">
<?php require_once('header.php');?>
</div>

         <section id="ccontact-section">
           <div class="ccontainer">
           	 <h1>Contact Us</h1>
             <div class="ccontact-form">

                  
                <div class="ccon">
				        	<span class="form-info"><h3>Address</h3></span>
				        	<span class="form-info"><h4>&nbsp &nbsp &nbsp &nbsp &nbsp No. 234 / 2, Galle Rd, Colombo, Sri Lanka.</h4></span><br>
				        	<span class="form-info"><h3>Voice</h3></span>
				        	<span class="form-info"><h4>&nbsp &nbsp &nbsp &nbsp &nbsp +94-11-234-64-34</h4></span>
				        	<span class="form-info"><h4>&nbsp &nbsp &nbsp &nbsp &nbsp +94-72-221-73-11</h4></span><br>
				        	<span class="form-info"><h3>E-mail</h3></span>
				        	<span class="form-info"><h4>&nbsp &nbsp &nbsp &nbsp &nbsp SLQualityDivers@gmail.com</h4></span>
				        </div>
               
                <div>        
                    <form action = "mydata.php" method="POST"> 
			        	      <label>Email *</label><br>
                      <input type="Email" name="email" placeholder="Ex:-abcxyz@gmail.com" required><br>
			        	      <label>Message *</label><br>
                      <textarea   name="msg" placeholder="Enter your message" rows="5" required></textarea><br>
                      <button class="submit">Send</button> 
                    </form>   
                </div>
             </div>
<br><br><br>
             <div clas ="cmap">
              <center>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.580534416899!2d79.84461463788585!3d6.940629805537807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae258d4697337c1%3A0xe17ce48f52e4385d!2zUG9ydCBvZiBDb2xvbWJvIOC2muC3nOC3heC2uSDgt4Dgtrvgt4_gtrog4K6V4K-K4K604K-B4K6u4K-N4K6q4K-BIOCupOCvgeCuseCviOCuruCvgeCuleCuruCvjQ!5e0!3m2!1sen!2slk!4v1622704963651!5m2!1sen!2slk" width="50%" height="50%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </center>
             </div>

           </div>
         </section>

<div class="footerr">
<?php require_once('footer.php');?>
</div>

</body>
</html>