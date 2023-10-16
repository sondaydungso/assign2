<!DOCTYPE html>
<html lang="en">
<head>
	<!--Logo and CSS link -->
	<meta charset="utf-8">
	<meta name="schoolproject" content="index">
	<title>MTD Corporate</title>
	<link rel="icon" type="image/x-icon" href="images/page_logo.png">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	
</head>
<body>

	<!-- 2 background vids on the sides -->
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

	<!--Context-->
	<h1>Still not knowing what you should do in the new job? Click "Job Description" above</h1>

	<p>Want to apply? Click "Apply now" :<a class="link" href="apply.html">Apply now</a>( Click the blank space to see what happen)</p>
	<p>Currently, we are working out with some company to provide the best service for the customers:</p>
	<div id="flexbox">
	<div><a href="https://www.youtube.com/"><img class="indp" src="images/youtube.png" alt="Youtube Logo"></a></div>
	<div><a href="https://www.facebook.com/"><img class="indp" src="images/facebook.png" alt="Facebook Logo"></a></div>
	<div><a href="https://www.google.com/"><img id="indp1" src="images/google.png" alt="Google Logo"></a></div>
	</div>	
	<br><br><br><br><br><br><br><br><br>
	<hr>

	<!--Footer-->
	<?php
       include("footer.inc")
	?>

	</article>
</body>
</html>
