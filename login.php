<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Login - SEECS Academics Club</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
	<link href="./assets/dependencies/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/dependencies/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/dependencies/font-awesome.css" rel="stylesheet">

	<link href="./assets/css/css" rel="stylesheet">    
	<link href="./assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/signin.css" rel="stylesheet" type="text/css">

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
			
			<a class="brand" href="index.php">
				SEECS Academics Club				
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">						
						<a href="signup.php" class="">
							Don't have an account? Signup Now
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<div class="account-container">
	
	<div class="content clearfix">
		
		<form action="login.php" method="post">
		
			<h1>Member Login</h1>		
			
			<div class="login-fields">
				
				<p>Please provide your details</p>
				
				<div class="field">
					<label for="email">Email Address:</label>
					<input type="text" id="email" name="email" placeholder="Email Address" class="login username-field" required>
				</div>
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" placeholder="Password" class="login password-field" required>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4">
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<input class="button btn btn-primary btn-large" type="submit" value="Log In" name="signin">

			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	<?php
		$con = new mysqli('127.0.0.1', 'root', '', 'cogman');

		if ($con->connect_error) {
		    die('Connect Error (' . $con->connect_errno . ') ');
		}

		if (isset($_POST['signin'])){
			$pass = hash_hmac('sha256', $_POST["password"], 'cogman');

			if (!strpos($_POST["email"], '@seecs.edu.pk')){
				$query = mysqli_query($con, "SELECT admins.pass AS password FROM admins WHERE admins.username='$_POST[email]'")->fetch_assoc();
				// admins
				if ( strlen($query["password"] ) == 0) {
					$response = "<div class='alert alert-danger'><strong>Sign in failed!</strong></div>";
				}
				else if ( hash_equals( $query["password"], $pass )){
					$_SESSION["email"] = $_POST["email"];
					header("Location: index.php"); /* Redirect browser */
					exit();
				}
			}
			else {
				$query = mysqli_query($con, "SELECT user.pass AS password FROM user WHERE user.email='$_POST[email]'")->fetch_assoc();

				if ( strlen($query["password"] ) == 0) {
					$response = "<div class='alert alert-danger'><strong>Sign in failed!</strong> Account does not exist. <a href='signup.php' class='alert-link'>Signup</a> to create an account.</div>";
				}
				else if ( hash_equals( $query["password"], $pass )){
					$_SESSION["email"] = $_POST["email"];
					header("Location: index.php"); /* Redirect browser */
					exit();
				}
				else {
					$response = "<div class='alert alert-danger'><strong>Sign in failed!</strong> Incorrect password.</div>";
				}
			}

		}

		if(isset($response)){
			echo $response;
		}
		$con->close();
	?>
</div> <!-- /account-container -->

<div class="login-extra">
	<a href="#">Reset Password</a>
</div> <!-- /login-extra -->

<script src="./assets/dependencies/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="./assets/js/top-bar.js"></script>
<script type="text/javascript" src="./assets/js/bsa-ads.js"></script>
<script src="./assets/dependencies/bootstrap.js"></script>
<script src="./assets/js/signin.js"></script>

</body>
</html>