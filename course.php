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
					<li><a href="javascript:;">Profile</a></li>
					<li><a href="javascript:;">Settings</a></li>
					<li><a href="javascript:;">Help</a></li>
					<li><a href="javascript:;">Logout</a></li>
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
        <li class="active"><a href="index.html"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="course.php"><i class="icon-list-alt"></i><span>Courses</span> </a> </li>
        <li class="subnavbar-open-right"><a href="login.php"><i class="icon-facetime-video"></i><span>Log in</span> </a></li>
        <li><a href="signup.php"><i class="icon-code"></i><span>Sign up</span> </a> </li>
        <li class="dropdown subnavbar-open-right"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>

<div id="delete_message">
    <h2></h2>
    <form method="POST">
	    <input type="button" class="btn btn-primary" value="Cancel" name="cancel" id="cancel">
	    <input type="submit" class="btn btn-danger" value="Delete" name="delete">
    </form>
</div>

<div class="account-container">
  <div class="content clearfix">
    <form action="course.php" method="post">
    
      <h1>Add Course</h1>   
      
      <div class="login-fields">
        
        <div class="field">
          <label for="cid">Course ID</label>
          <input type="text" id="cid" name="cid" placeholder="CS220" required="true">
        </div>
        
        <div class="field">
          <label for="cname">Course Name</label>
          <input type="text" id="cname" name="cname" placeholder="Database Systems"  required="true">
        </div>

        <div class="field">
          <label for="dept" class="select">Offering Department:</label>
          <select class="form-control" id="dept" name="dept"  required="true">
            <option value=""></option>
            <option value="CS">CS</option>
            <option value="SE">SE</option>
            <option value="EE">EE</option>
            <option value="MATH">MATH</option>
            <option value="BSH">Basic Sciences &amp; Humanities</option>
          </select>
        </div>
        
      </div> <!-- /login-fields -->
        <input type="submit" name="add" value="Add" class="button btn btn-success btn-large">
    </form>
    
  </div> <!-- /content -->
  <?php
	$con = new mysqli('127.0.0.1', 'root', '', 'cogman');

	if ($con->connect_error) {
	    die('Connect Error (' . $con->connect_errno . ')');
	}
	if(isset($_POST['add'])){
		$sql = "INSERT INTO course (id, cname, dept) VALUES ('$_POST[cid]','$_POST[cname]','$_POST[dept]')";
		if(mysqli_query($con,$sql)){
			$response = "<div class='alert alert-success'><strong>Success!</strong> ".$_POST["cname"]." has been added.</div>";
		} else {
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> Kindly check if the course already exists.</div>";
		}
	}

	else if(isset($_POST["delete"])){
		if(mysqli_query($con, "DELETE FROM course WHERE course.id='$_COOKIE[id]'"))
			$response = "<div class='alert alert-danger'><strong>$_COOKIE[name] deleted!</strong></div>";
	}

	if(isset($response)){
		echo $response;
	}

?>
</div> <!-- /account-container -->
<!-- populate database -->

<div class="container courseContainer">
    <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Courses 
              <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                <i class="fa fa-filter"></i>
              </span>
            </h3>
          </div>
          <div class="panel-body" style="display: none;">
            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Courses" />
          </div>
          <table class="table table-hover" id="dev-table">
            <thead>
              	<tr>
                <th>Course #</th>
                <th>Course Name</th>
                <th>Department</th>
             	</tr>
            </thead>
            <tbody>
            <?php
              $result = mysqli_query($con,"SELECT * FROM course");
              if(mysqli_num_rows($result) == 0){
              	echo "<tr><td colspan=3>No record found!</td></tr>";
              }
              while ($row = $result->fetch_assoc())
              {
                echo "<tr>";
                foreach($row as $value) echo "<td>$value</td>";
                echo "<td><i class='fa fa-pencil-square-o' aria-hidden='true' title='Edit'></i></td>
                	  <td><i class='fa fa-minus-circle' aria-hidden='true' title='Delete'></i></td>";
                echo "</tr>";
              }
              $con->close();
            ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>

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