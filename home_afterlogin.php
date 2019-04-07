<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Park ME</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta http-equiv="Content-Language" content="en">
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<link rel="icon" href="assets/img/app-icon-transparent.png">
		
<?php
		session_start();
require 'class.user.php';
$user = new User();
$uemail = $_SESSION['uemail'];

if (!$user->get_session()){
 header("location:login.php");
}

if (isset($_GET['q'])){
 $user->user_logout();
 header("location:index.php");
 }
		

?>
	</head>
	<body class="landing is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
				

					<header id="header" class="alt">
						<h1><a href="index.html">ParkMe</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span id="NameToggle">Menu</span></a>
									<?php
									if ($user->get_session()){
			$name = $user->get_fullname($uemail);
			$msg = 'Welcome ';
			$wc = $msg.$name;
			echo "<script type='text/javascript'>document.getElementById('NameToggle').innerHTML='$wc';</script>";
		}
									?>
									<div id="menu">
										<ul>
											<li><a href="index.html">Home</a></li>
											<li><a href="parks.php">Parks</a></li>
											<!--li><a href="registration.php">Sign Up</a></li-->
											<li><a href="home_afterlogin.php?q=logout">Logout</a></li>
											<li><a href="contact-us.php">Contact us</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
						<h1><img src="assets/img/app-icon-transparent.png" alt="login-logo" class="app-logo"><h1>
						  <h2>Park Me</h2>
							<p>The smart parking app<br />
							for your need<br />
					      <!--strong>park me</strong--></p>
							<ul class="actions special">
								<li><a href="home_afterlogin.php?q=logout" class="button primary">Logout</a></li>
							</ul>
						</div>
						<a href="#one" class="more scrolly" >Learn More</a>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style1 special" >
						<div class="inner" >
							<header class="major">
								<h2>Parking made easy</h2>
								<p>Find your best option for every journey</p>
							</header>
							<ul class="icons major">
								<li><span class="icon fa-car major style1"><span class="label">Lorem</span></span></li>
								<li><span class="icon fa-motorcycle major style2"><span class="label">Ipsum</span></span></li>
								<li><span class="icon fa-truck major style3"><span class="label">Dolor</span></span></li>
							</ul>
						</div>
					</section>

				<!-- Two -->
					<section id="two" class="wrapper alt style2">
				
						<section class="spotlight">
							<div class="image"><img src="images/pic02.jpg" alt="" /></div><div class="content">
								<h2>Find nearby <br />
								Car Parks</h2>
								<p>Minul Ayyah</p>
								<ul class="actions special">
								<li><a href="map.php" target="_blank" class="button primary">Find Car Parks</a></li>
							</ul>
							</div>
						</section>
						
					</section>

				<!-- Three -->
					<section id="three" class="wrapper style3 special">
						<div class="inner">
							<header class="major">
								<h2>What users are saying</h2>
								<p>Don’t just take our word for it – check out some of the latest customer reviews for our London parking spaces</p>
							</header>
							<ul class="features">
								<li class="icon fa-heart-o">
								<h2>Minul</h2>
		
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-laptop">
									<h3>Ac Augue Eget</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-code">
									<h3>Mus Scelerisque</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-headphones">
									<h3>Mauris Imperdiet</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-heart-o">
									<h3>Aenean Primis</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
								<li class="icon fa-flag-o">
									<h3>Tortor Ut</h3>
									<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
								</li>
							</ul>
						</div>
					</section>

				<!-- CTA -->
					<section id="cta" class="wrapper style4">
						<div class="inner">
							<header>
								<h2>Rent out your parking space</h2>
								<p>Would you like to join with us. It‘s free to list and only takes a few minutes to get up and running.</p>
							</header>
							<ul class="actions stacked">
								<li><a href="contact-us.php" class="button fit primary">Contact Us</a></li>
								<li><a href="#" class="button fit">Learn More</a></li>
							</ul>
						</div>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
		<div id="container">

<div id="footer"></div>
</div>

	</body>
</html>