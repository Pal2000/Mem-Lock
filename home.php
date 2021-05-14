<?php
session_start();
include("connection.php");
include("functions.php");
 $user_data=check_login($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="css/stylehome.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
    
    <title>Mem-Lock</title>
</head>
<body>
    <div class="container">
		<div class="navbar">
		<div class="logo">Mem-Lock </div>
			<nav>
				<ul>
					<li class="drop">
					 
					 <?php
						if(!empty($user_data)){
							echo "<a href='logout.php' class='drop'>  Logout  
							
							</a>";
						// 	echo "<div class='dropdown'>
						// 	<button class='dropbtn'>".$user_data['user_name']."</button>
						// 	<div class='dropdown-content'>
						// 	  <a href='#'>Link 1</a>
						// 	  <a href='#'>Link 2</a>
						// 	  <a href='#'>Link 3</a>
						// 	</div>
						//   </div>";
							

						} 
						else {
							echo "<a href='login.php'>Login/SignUp</a>";
						}
					?> 
					</li>
					<li>
					<?php
						if(!empty($user_data)){
							echo "<a href='edit-profile.php'> Profile </a>";
							
						} 
						// else {
						// 	echo "<a href='login.php'>My Memories</a>";
						// }
					?> 
					</li>

					<li>
					<?php
						if(!empty($user_data)){
							echo "<a href='mystories.php'> My Memories </a>";
							
						} 
						else {
							echo "<a href='login.php'>My Memories</a>";
						}
					?> 
					</li>
					<li>
						<a href="">Home</a>
					</li>
					
				</ul>
			</nav>
		</div>
		<!-- <div>
			<p> hey, <?php echo $user_data['name']; ?></p>
		</div> -->
		<div class="info">
			<h2>Store your memories forever</h2>
		</div>
		
		<div class="container-card">
		
			<div class="card">
				<div class="face face1">
					<div class="content">
						<div class="icon">
							<img src="images/im1.jpg" alt="" class="mem-pic">
						</div>
					</div>
				</div>
				<div class="face face2">
					<div class="content">
						<h3>
							<p>Goa Trip</p>
						</h3>
						<p>My trip to Goa with my Buddies.😃😎✌</p>
					</div>
				</div>
			</div>
			
			<div class="card">
				<div class="face face1">
					<div class="content">
						<div class="icon">
						<img src="images/im2.jpeg" alt="" class="mem-pic">
						</div>
					</div>
				</div>
				<div class="face face2">
					<div class="content">
						<h3>
							<p>Hiking</p>
						</h3>
						<p>🥰🌟Woohooo!! My first hiking.🌟</p>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="face face1">
					<div class="content">
						<div class="icon">
						<img src="images/im3.jpg" alt="" class="mem-pic">
						</div>
					</div>
				</div>
				<div class="face face2">
					<div class="content">
						<h3>
							<p> Christmas Party</p>
						</h3>
						<p>Christmas with fam.☃🎄✨🎉🎊🎅</p>
						
					</div>
				</div>
			</div>
			
		</div>
		<div class="memory">
			<p>"The best thing about memories is making them."</p>
		</div>
		<!-- <div class="start">
			<a href="" >Lock your memory </a>
		</div> -->

		<div class="review-card">
			<!-- <h2>Reviews</h2> -->
						
			<div class="slideshow-container">

				<div class="mySlides">
					<q>Mem-Lock is one of best platform to store our happy moments and incidents in terms of photos and texts securely. I can use it whenever I want. I just loved it.  </q>
					<p class="author">- John Keats</p>
				</div>

				<div class="mySlides">
					<q>Whenever my heart wants to refresh my good moments in life, I just open Mem-Lock. It gives me pleasure.</q>
					<p class="author">- Ernest Hemingway</p>
				</div>

				<div class="mySlides">
					<q>Mem-Lock is an awesome site. I re-enjoy my good and happy time whenever I open it.</q>
					<p class="author">- Thomas A. Edison</p>
				</div>

				<a class="prev" onclick="plusSlides(-1)">❮</a>
				<a class="next" onclick="plusSlides(1)">❯</a>

			</div>

			<div class="dot-container">
				<span class="dot" onclick="currentSlide(1)"></span> 
				<span class="dot" onclick="currentSlide(2)"></span> 
				<span class="dot" onclick="currentSlide(3)"></span> 
			</div>
						
		</div>
		<br><br>
		<div class="footer-head">
			<div class="footer">
				<div class="footer-left">
					<h2>Mem-Lock</h2>
					<p> &copy; All rights Reserved 2021 <a href="home.php" style="text-decoration:none; color:rgb(197, 80, 80);"> Mem-Lock </a></p>
				</div>
				<div class="footer-right">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

				</div>
			</div>
		</div>
	</div>
		
	<script>
	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	showSlides(slideIndex = n);
	}

	function showSlides(n) {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");
	if (n > slides.length) {slideIndex = 1}    
	if (n < 1) {slideIndex = slides.length}
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";  
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", "");
	}
	slides[slideIndex-1].style.display = "block";  
	dots[slideIndex-1].className += " active";
	}
	</script>

</body>
</html>