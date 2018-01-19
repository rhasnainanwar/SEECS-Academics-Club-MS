<?php
  include "init.php";
  if ( count($_SESSION) == 0){
    header("Location: login.php"); /* Redirect browser */
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Welcome to SEECS Academics Club!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="./assets/dependencies/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/style.css" rel="stylesheet">
<link href="./assets/css/signin.css" rel="stylesheet">
<link href="./assets/dependencies/font-awesome.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body data-post="" data-gr-c-s-loaded="true">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">SEECS Academics Club </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
			<li class="dropdown">						
				<a href="shortcodes.html#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-user"></i> 
					Admin
					<b class="caret"></b>
				</a>
				
				<ul class="dropdown-menu">
          <li><a href="login.php">Logout</a></li>
        </ul>
			</li>
		</ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>

<div class="account-container">
  <div class="content clearfix">
    <form action="course.php" method="post">
    
      <h1>Calculus I Session Feedback</h1>   
      
      	<?php
      		echo "<p>Date: 15 June, 2017 </p>";
      		echo "<h4>Mentor: Raja Hasnain Anwar </h4><br/>";
      	?>
      <div class="login-fields">
        
        <div class="field">
          <label for="Speech" class="select">Speech Clarity: </label>
          <input type="number" id="Speech" name="Speech" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>
        
        <div class="field">
          <label for="prep" class="select">Topic Preparation: </label>
          <input type="number" id="prep" name="prep" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>

        <div class="field">
          <label for="presentation" class="select">Presentation: </label>
          <input type="number" id="presentation" name="presentation" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>
        
        <div class="field">
          <label for="material" class="select">Study Material: </label>
          <input type="number" id="material" name="material" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>

        <div class="field">
          <label for="time" class="select">Time Management: </label>
          <input type="number" id="time" name="time" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>

        <div class="field">
          <label for="interation" class="select">Interation: </label>
          <input type="number" id="interation" name="interation" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>

        <div class="field">
          <label for="qna" class="select">Question &amp; Answer: </label>
          <input type="number" id="qna" name="qna" min="1.0" max="5.0" step="0.1" placeholder="1.0 - 5.0" required="true">
        </div>
        
      </div> <!-- /login-fields -->
      	<label for="suggestion" class="select">Suggestions: </label>
        <textarea class="form-control" id="suggestion" name="suggestion" rows="5"></textarea>
        <input type="submit" name="submit" value="Submit" class="button btn btn-success btn-large">
    </form>
    
  </div> <!-- /content -->
  <?php
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO course (id, cname, dept) VALUES ('$_POST[cid]','$_POST[cname]','$_POST[dept]')";
		if(mysqli_query($con,$sql)){
			$response = "<div class='alert alert-success'><strong>Success!</strong> ".$_POST["cname"]." has been added.</div>";
		} else {
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> Kindly check if the course already exists.</div>";
		}
	}

	if(isset($response)){
		echo $response;
	}

	$con->close();

?>
</div> <!-- /account-container -->
<!-- populate database -->

<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> © 2017 <a href="">SEECS Academics Club</a>.</div>
      </div><!-- /row --> 
    </div><!-- /container --> 
  </div><!-- /footer-inner --> 
</div><!-- /footer -->

<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="./assets/dependencies/jquery-1.7.2.min.js"></script> 
<script src="./assets/dependencies/bootstrap.js"></script>
<script src="./assets/js/search.js"></script>
<script src="./assets/js/base.js"></script>

</body>
</html>