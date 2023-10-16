<!DOCTYPE html>
<html lang="en">
<head>
<title>MTD Enchantments </title>

<meta charset="utf-8">
<meta name="description" content="Our group's enchantments">
<meta name="author" content="group">
<link rel="icon" type="image/x-icon" href="images/page_logo.png">
<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>
    	<!-- Both side background -->
		<div id="sidenav"> 
			<video autoplay muted loop>
				<source src="images/video.mp4" type="video/mp4">
				Your browser does not support HTML5 video.
			  </video>
		</div>
	
		<div id="sidenav2"> 
			<video autoplay muted loop>
				<source src="images/video.mp4" type="video/mp4">
				Your browser does not support HTML5 video.
			  </video>
		</div>
	
		<article id="pagecontent">
	
		<!--Navigation bar-->
		<a href="index.php">
			<img id="logo" src="images/logo-Copy.png" alt="MTD Tech Corporate Offical Logo">
		</a>
<h1 id="welcome">Welcome to our company</h1>
<?php
    include("header.inc")
?>

<h1> <strong>Enhancement #1: </strong>Video Page Background </h1>
<p>We implemented two videos on the sidebar of our page to give a futuristic feel.
</p>
<h2>How it works</h2>
<ul>
	<li ><p class="canMargin">We put all our page content into the 'article' tag. Then we created two divisions containing 2 autoplay loop videos before the 'article' tag</p>
		<img src="images/enhancement1.png" alt="Screenshot of our code">
	</li>
	<li>Then we style the 2 sidenav videos in css so that the videos are:
		<ol class="canMargin">
			<li> Fixed</li>
			<li> Stay at the top left</li>
			<li class="canMargin"> Has height and width that fits the side nav and extend to the end of the page</li>
		</ol>	
		<img src="images/enhancement1(2).png" alt="Screenshot of our code"/>
	</li>
	<li><p class="canMargin">We also made sure the page content ('article' tag) has margin on the size to fit the video and padding to seperate them</p>
		<img src="images/enhancement1(3).png" alt="Screenshot of our code"/>
	</li>
</ul>

<br class="clearAbove">

<h1> Enhancement#2: The blink effect</h1>
<p> We added the blink effect to the salary information on jobs.html to add emphasis.</p>
<h2>How it works</h2>
<ul>
	<li><p class="canMargin">Here we gave the salary range class and id so that makes it easier to create blink effect</p>
	<img src="images/enhancement2.png" alt="Screenshot of our code"/></li>
	<li class="canMargin">The keyframe is a special rule in CSS which change from 1 animation to another</li>
	<li><p class="canMargin">The lower the opacity is, the harder it is to see the animation</p>
	<img src="images/enhancement2(2).png" alt="Screenshot of our code"/></li>
</ul>
<hr>
<?php
       include("footer.inc")
?>
    </article>
</body>

