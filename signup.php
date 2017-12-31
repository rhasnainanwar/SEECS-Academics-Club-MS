<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Signup - SEECS Academics Club</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
	<link href="./assets/dependencies/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/dependencies/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/dependencies/font-awesome.css" rel="stylesheet">

	<link href="./assets/css/css" rel="stylesheet">    
	<link href="./assets/css/signin.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="./assets/select2/css/select2.min.css" rel="stylesheet" />
</head>

<body data-post="" data-gr-c-s-loaded="true" style="">
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				SEECS Academics Club				
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">						
						<a href="login.html" class="">
							Login 
						</a>
						
					</li>
					<li class="">						
						<a href="index.html">
							<i class="icon-chevron-left"></i>
							Back to Homepage
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->

<div class="account-container register">
	<div class="content clearfix">
		<form action="signup.html" method="post">
			<h1>Signup for your SAC Account</h1>
			
			<div class="login-fields">
				
				<p>Provide the following details:</p>
				<div class="field">
					<label for="fname">First Name:</label>	
					<input type="text" id="fname" name="fname" value="" placeholder="First Name" class="login-row" required="true">
				</div> 

				<div class="field">
					<label for="fname">Last Name:</label>	
					<input type="text" id="lname" name="lname" value="" placeholder="Last Name" class="login-row" required="true">
				</div>

				<div class="field">
					<label for="reg">Registration Number:</label>	
					<input type="text" id="reg" name="reg" value="" placeholder="Registration Number" required="true">
				</div>

				<div class="field">
					<label for="cell">Cell Number:</label>	
					<input type="tel" id="cell" name="cell" value="" placeholder="Cell Number">
				</div>
				
				<div class="field">
					<label for="email">Email Address:</label>
					<input type="text" id="email" name="email" value="" placeholder="Email Address" required="true">
				</div> 
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" required="true">
				</div> 
				
				<div class="field">
					<label for="section" style="display: block; !important;">Select your batch:</label>
					<select class="form-control" required="true" id="section" name="section">
						<option value="">Please Select</option>
						<optgroup label="Computer Science">
						    <option value="BSCS4">BSCS4</option>
						    <option value="BSCS5">BSCS5</option>
							<option value="BSCS6">BSCS6</option>
							<option value="BSCS7">BSCS7</option>
					  	</optgroup>
						<optgroup label="Electircal Engineering">
							<option value="BEE6">BEE6</option>
							<option value="BEE7">BEE7</option>
							<option value="BEE8">BEE8</option>
						    <option value="BEE9">BEE9</option>
					  	</optgroup>
					  	<optgroup label="Software Engineering">
						    <option value="BESE5">BESE5</option>
							<option value="BESE6">BESE6</option>
							<option value="BESE7">BESE7</option>
							<option value="BESE8">BESE8</option>
					  	</optgroup>
					</select>
				</div> 

				<div class="field">
					<label style="display: block !important;">I'm also...</label>
					<input type="checkbox" name="mentor" id="mentor" value="mentor">
        			<label for="mentor" style="display: inline !important;">Mentor</label>
        			<input type="checkbox" name="executive" id="executive" value="executive">
        			<label for="executive" style="display: inline !important;">Executive</label>
				</div>

				<div class="mentor">
				<div class="field">
					<label for="subjects" style="display: block; !important;">I can teach...</label>
					<select class="dropdownSearch" id="subjects" name="subjects" style="width: 80%;" multiple>
					<?php
						$mysqli = new mysqli('127.0.0.1', 'root', '', 'cogman');

						if ($mysqli->connect_error) {
						    die('Connect Error (' . $mysqli->connect_errno . ') ');
						}
						
						$result = mysqli_query($mysqli,"SELECT id, cname FROM course");

						while ($row = $result->fetch_assoc())
		              	{
							echo "<option value='".$row["id"]."'>".$row["cname"]."</option>";
		              	}
		              $mysqli->close();
					?>
					</select>
				</div>

				<div class="field">
					<label for="residence" style="display: block !important;">Residence:</label>
					<select class="form-control" id="residence" name="residence">
						<option value="">Please Select</option>
						<option value="H">Hosteler</option>
						<option value="D">Day Scholar</option>
					</select>
				</div>
				
				
				</div>

				<div class="executive">
					<label for="role" style="display: block !important;">Role:</label>
					<select class="form-control" id="role" name="role">
						<option value="">Please select</option>
						<option value="Human Resource Head">Human Resource Head</option>
						<option value="Human Resource Executive">Human Resource Executive</option>
						<option disabled>-------------</option>
						<option value="Marketing Head">Marketing Head</option>
						<option value="Marketing Executive">Marketing Executive</option>
						<option disabled>-------------</option>
						<option value="Operations Head">Operations Head</option>
						<option value="Operations Executive">Operations Executive</option>
						<option disabled>-------------</option>
						<option value="Media Head">Media Head</option>
						<option value="Media Executive">Media Executive</option>
					</select>
				</div>
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4">
					<label class="choice" for="Field">Agree with the Terms &amp; Conditions.</label>
				</span>
									
				<input class="button btn btn-primary btn-large" type="submit" value="Register" name="singup">
				
			</div>
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
	Already have an account? <a href="login.html">Login to your account</a>
</div> <!-- /login-extra -->

<script src="./assets/dependencies/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="./assets/js/top-bar.js"></script>
<script type="text/javascript" src="./assets/js/bsa-ads.js"></script>
<script src="./assets/dependencies/bootstrap.js"></script>
<script src="./assets/js/signin.js"></script>
<script src="./assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.dropdownSearch').select2();
});
</script>
</body>
</html>