<?php
session_start();
  $con = new mysqli('127.0.0.1', 'root', '', 'cogman');
  if ($con->connect_error) {
      die('Connect Error (' . $con->connect_errno . ') ');
  }
  if ( count($_SESSION) == 0 ){
    header("Location: login.php"); /* Redirect browser */
    exit();
  }
  else if($_SESSION["type"] == "user"){
    header("Location: profile.php"); /* Redirect browser */
    exit();
  }
  else if(!isset($_GET["cid"])){
     header("Location: index.php"); /* Redirect browser */
    exit();
  }

  $result = mysqli_query($con,"SELECT cname FROM course WHERE id = '$_GET[cid]'")->fetch_assoc();
  if(!$result){
    header("Location: index.php"); /* Redirect browser */
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Create Help Session | SEECS Academics Club!</title>
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
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.php">SEECS Academics Club </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
			<li class="dropdown">						
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php echo $_SESSION["name"]; ?>
					<b class="caret"></b>
				</a>
				
				<ul class="dropdown-menu">
					<li><a href="logout.php">Logout</a></li>
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
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span> </a> </li>
        <li><a href="executives.php"><i class="fa fa-briefcase"></i><span>Executives</span> </a> </li>
        <li><a href="course.php"><i class="fa fa-book"></i><span>Courses</span> </a> </li>
        <li><a href="mentors.php"><i class="fa fa-graduation-cap"></i><span>Mentors</span> </a></li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>

<div class="account-container">
  <div class="content clearfix">
    <form action="session.php" method="post">
    
      <h1>Create a Help Session</h1>   
      
      <div class="login-fields">

        <div class="field">
          <h3>For <?php echo $result["cname"]; ?></h3>
        </div>

        <div class="field">
          <label for="dt" class="select">Date &amp; Time of Session:</label>
          <input type="datetime-local" name="dt" required>
        </div>
        
        <div class="field">
          <label for="room">Room:</label>
          <input type="text" name="room" placeholder="Room e.g., CR-15" required>
        </div>

        <div class="field">
          <label for="topics">Topics:</label>
          <input type="text" name="topics" placeholder="Topics" required>
        </div>

        <div class="field">
          <label for="executive" class="select">Select Mentor:</label>
          <select class="dropdownSearch" id="executive" name="executive" style="width: 80%;" required>
          <?php
            $con = new mysqli('127.0.0.1', 'root', '', 'cogman');

            if ($con->connect_error) {
                die('Connect Error (' . $con->connect_errno . ') ');
            }
            echo "<option value=''>Please Select</option>";
            $result = mysqli_query($con,"SELECT reg, CONCAT(fname, ' ', lname) AS name FROM user JOIN can_teach ON mentorID = reg WHERE course = '$_GET[cid]'");

            while ($row = $result->fetch_assoc())
            {
              echo "<option value='".$row["reg"]."'>".$row["name"]."</option>";
            }
          ?>
          </select>
        </div>

        <div class="field">
          <label for="executive" class="select">Select Executive:</label>
          <select class="dropdownSearch" id="executive" name="executive" style="width: 80%;" required>
          <?php
            $con = new mysqli('127.0.0.1', 'root', '', 'cogman');

            if ($con->connect_error) {
                die('Connect Error (' . $con->connect_errno . ') ');
            }
            echo "<option value=''>Please Select</option>";
            $result = mysqli_query($con,"SELECT reg, CONCAT(fname, ' ', lname) AS name FROM user JOIN executive ON reg = id WHERE role LIKE '%Executive'");

            while ($row = $result->fetch_assoc())
            {
              echo "<option value='".$row["reg"]."'>".$row["name"]."</option>";
            }
          ?>
          </select>
        </div>

        <div class="field">
          <label for="batch" class="select">Select batch:</label>
          <select class="form-control" required="true" id="batch" name="batch">
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
        
      </div> <!-- /login-fields -->
        <input type="submit" name="add" value="Add" class="button btn btn-success btn-large">
    </form>
    
  </div> <!-- /content -->
  <?php
	if(isset($_POST['add'])){
		$sql = "INSERT INTO helpsession (stime, room, topics, courseID, incharge) VALUES ('$_POST[dt]','$_POST[room]','$_POST[topics]', '$_GET[cid]', $_POST[executive])";
		if(mysqli_query($con,$sql)){
			$response = "<div class='alert alert-success'><strong>Success!</strong> ".$_POST["cname"]." has been added.</div>";
		} else {
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> Kindly check if the course already exists.</div>";
		}
	}

	if(isset($response)){
		echo $response;
	}

?>
</div> <!-- /account-container -->

<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> © 2018 <a href="">SEECS Academics Club</a>.</div>
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