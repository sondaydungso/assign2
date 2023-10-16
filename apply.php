<!DOCTYPE html>
<html lang="en">
<head>
<title>MTD Application Form</title>

<meta charset="utf-8">
<meta name="description" content="Application form for MTD">
<meta name="author" content="Tan Pham Duy">
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
	<a href="index.html">
		<img id="logo" src="images/logo-Copy.png" alt="MTD Tech Corporate Offical Logo">
	</a>
	<h1 id="welcome">Welcome to our company</h1>
<?php
    include("header.inc")
?>



<form id="application" method="post" action="https://mercury.swin.edu.au/it000000/formtest.php">
<h1 id="formTitle">Tech Position Application Form</h1>
<h2 id="formTitle2">MTD CORPORATE</h2>



<fieldset>
<legend>Desired Position</legend>
<label for="jobNum">Please enter your job reference number
    <input type="text" name="jobNum" id="jobNum" 
    pattern="^\d{5}$"
    placeholder="00000"
    required
    />
</label>
</fieldset>

<fieldset>
    <legend>Applicant's details</legend>
    <p>
        <label for="firstName">First Name
        <input type="text" name="firstName" id="firstName" 
        pattern="^[A-Za-z ]{1,20}$"
        required="required"
        placeholder="E.g. Duy Tan"
        /></label>

        <label for="familyName">First Name
        <input type="text" name="familyName" id="familyName" 
        pattern="^[A-Za-z ]{1,20}$"
        required="required"
        placeholder="E.g. Pham"
        /></label>
    </p>

    <p>
        <label for="birthday">Date of Birth
        <input type="text" name="birthday" id="birthday" placeholder="dd/mm/yyyy" pattern="^\d{1,2}\/\d{1,2}\/\d{4}$" required/> 
        </label>
    </p>

    <fieldset>
        <legend>Gender</legend>
        <label><input type="radio" name="gender" value="male" required/>Male</label>
        <label><input type="radio" name="gender" value="female"/>Female</label>
        <label><input type="radio" name="gender" value="female"/>Rather not say</label>
        <label><input type="radio" name="gender" value="other"/>Other</label>
    </fieldset>

    
    <p>
        <label for="streetAddress"> Street Address <input type="text" 
            name="streetAddress" id="streetAddress" placeholder="E.g. John St" 
            required
            pattern="^[A-Za-z0-9 ]{1,40}$"
            /></label>
        <label for="suburb"> Suburb/Town <input type="text" 
            name="suburb" id="suburb" placeholder="E.g. Hawthorn"
            required
            pattern="^[A-Za-z0-9 ]{1,40}$"
            /></label>
    </p>
        
    <p><label for="state">State
        <select name="state" id="state" required>
            <option value="">Please select</option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="WA">WA</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
        </select>
        </label>   
    </p>

    <p>
        <label for="postcode">Postcode
            <input id="postcode" name="postcode" type="text" 
            pattern="\d{4}$"
            required
            placeholder="E.g. 3121">
        </label>
    </p>

    <p>
        <label for="email">Email Address
            <input id="email" name="email" type="email" placeholder="name@domain.com" 
            required
            pattern="^[A-Za-z0-9]+\@[A-Za-z0-9]+$"/> 
        </label>
    </p>

    <p>
        <label for="telephone">Phone Number
        <input type="text" name="telephone" id="telephone" 
        pattern="^[0-9 ]{8,20}$"
        required="required"
        placeholder="012345678"
        /></label>
    </p>

    
    <label>Skill List</label>
    <p>
        <label><input type="checkbox" name="skill[]" value="front" checked/>Front-end Coding</label>
        <label><input type="checkbox" name="skill[]" value="back"/>Back-end Coding</label>
        <label><input type="checkbox" name="skill[]" value="teamworkAbility"/>Teamwork Ability</label>
        <label><input type="checkbox" name="skill[]" value="design"/>Design</label>
        <label><input type="checkbox" name="skill[]" value="uptodate"/>Stay up to date with latest technology</label>
        <label><input type="checkbox" name="skill[]" value="management"/>Management ability</label>
        <label><input type="checkbox" name="skill[]" value="otherSkill"/>Other skills</label>
    </p>   
    
    <p>
        <label for="otherSkills"> Other skills <br>
        <textarea id="otherSkills" name="otherSkills" rows="4" cols="60" placeholder="Please write description of your other skills here!"></textarea>
        </label>    
    </p>

</fieldset>

<div id="applyButton">
    <div> <input  type="submit" value="Apply"/> </div>
    <div> <input  type="reset" value="Reset Answers"/> </div>
</div>

</form>

<hr>
<?php
       include("footer.inc")
?>
    </article>
</body>
</html>

