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
	else if($_SESSION["type"] == "admin"){
		header("Location: index.php"); /* Redirect browser */
	  exit();
	}

	$query = "SELECT reg, CONCAT(fname, ' ' ,lname) AS name, email, cellno, residence, batch FROM user WHERE email = '$_SESSION[email]'";
	$result = mysqli_query($con, $query)->fetch_assoc();

	$_SESSION["name"] = $result["name"];
	$_SESSION["id"] = $result["reg"];
	$cell = $result["cellno"];
	$residence = $result["residence"];
	$batch = $result["batch"];
?>
<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Welcome <?php echo $_SESSION["name"]; ?>!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="./assets/dependencies/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/style.css" rel="stylesheet">
<link href="./assets/css/profile.css" rel="stylesheet">
<link href="./assets/dependencies/font-awesome.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body data-post="" data-gr-c-s-loaded="true">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="profile.php">SEECS Academics Club</a>
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

<div id="delete_message">
    <h2></h2>
    <form method="POST" action="profile.php">
	    <input type="button" class="btn btn-primary" value="Cancel" name="cancel" id="cancel">
	    <input type="submit" class="btn btn-danger" value="Delete" name="delete">
    </form>
</div>

<div id="delete_message" class="user">
    <h2></h2>
    <form method="POST" action="deleteUser.php">
	    <input type="button" class="btn btn-primary" value="Cancel" name="cancel" id="cancel">
	    <input type="submit" class="btn btn-danger" value="Delete" name="delete">
    </form>
</div>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo $_SESSION["name"]; ?></h3>
        </div>
        <div class="panel-body">
            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>Registration:</td>
                    <td><?php echo $_SESSION["id"]; ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><a href=<?php echo '"mailto:'.$_SESSION["email"].'"'; ?>><?php echo $_SESSION["email"]; ?></a></td>
                  </tr>
                  <tr>
                    <td>Phone Number</td>
                    <td><?php echo $cell; ?></td>     
                  </tr>
                  <tr>
                    <td>Batch</td>
                    <td><?php echo $batch; ?></td>     
                  </tr>
                  <tr>
                    <td>Residence</td>
                    <td><?php if($residence == "H") echo "Hostler"; else echo "Day Scholar";?></td>     
                  </tr>
                  <?php
                  	$result = mysqli_query($con, "SELECT rating FROM mentor WHERE id = $_SESSION[id]")->fetch_assoc();
                  	if($result){
                  		$_SESSION["rating"] = $result["rating"];
                  		echo "<tr>
                  				<td>Teaching Rating:</td>
                  				<td>$_SESSION[rating]</td>
                  			</tr>";
                  	}
                  	$result = mysqli_query($con, "SELECT role FROM executive WHERE id = $_SESSION[id]")->fetch_assoc();
                  	if($result){
                  		$_SESSION["role"] = $result["role"];
                  		echo "<tr>
                  				<td>Designation:</td>
                  				<td>$_SESSION[role]</td>
                  			</tr>";
                  	}
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel-footer">
        	<span class="pull-right">
                <button data-original-title="Edit my details" data-toggle="tooltip" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                <button data-original-title="Delte my account" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
            </span>
        	</div>
        	<?php
        	if (isset($_SESSION["role"])) {
        		echo "<a href='attendance.php' class='btn btn-primary'>Mark Attendance</a>";
        	}
        	echo "<span style='width: 10px; display: inline-block;'></span>";
        	if (isset($_SESSION["rating"])) {
        		echo "<a href='updatePrefference.php' class='btn btn-primary'>Update Courses</a>";
        	}
        	?>
			<br><br>
		  </div>
        </div>
        <?php
	    if(isset($_POST["delete"])){
			if(mysqli_query($con, "DELETE FROM wants_to_study WHERE courseID='$_COOKIE[id]'"))
				$response = "<div class='alert alert-danger'><strong>$_COOKIE[name] deleted!</strong></div>";
			unset($_POST["delete"]);
		}
		else if( isset($_COOKIE["event"]) && $_COOKIE["event"] == "add"){
			$result = mysqli_query($con, "SELECT mentorID FROM can_teach WHERE mentorID = $_SESSION[id] && course = '$_COOKIE[id]'")->fetch_assoc();
			if($result)
				$response = "<div class='alert alert-danger'><strong>$_COOKIE[name] cannot be added as you teach this subject!</strong></div>";
			else if(mysqli_query($con, "INSERT INTO wants_to_study (stdID, courseID) VALUES ($_SESSION[id], '$_COOKIE[id]')"))
				$response = "<div class='alert alert-success'><strong>$_COOKIE[name] added!</strong></div>";
			else
				$response = "<div class='alert alert-danger'><strong>$_COOKIE[name] could not be added!</strong></div>";

			unset($_COOKIE["event"]);
		}
		if(isset($response)){
			echo $response;
		}
		?>
      </div>
    </div>

    <div class="container">
    <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Courses I Want to Study...
            </h3>
          </div>
          <table class="table table-hover">
            <thead>
              	<tr>
                <th>Course #</th>
                <th>Course Name</th>
                <th>Department</th>
             	</tr>
            </thead>
            <tbody>
            <?php
              $result = mysqli_query($con,"SELECT id, cname, dept FROM course JOIN wants_to_study ON courseID = id WHERE stdID = $_SESSION[id]");
              if(mysqli_num_rows($result) == 0){
              	echo "<tr><td colspan=3>No record found!</td></tr>";
              }
              while ($row = $result->fetch_assoc())
              {
                echo "<tr>";
                foreach($row as $value) echo "<td>$value</td>";
                echo "<td><i class='fa fa-minus-circle' aria-hidden='true' title='Delete'></i></td>";
                echo "</tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Remaining Courses
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
              $result = mysqli_query($con,"SELECT id, cname, dept FROM course WHERE id NOT IN ( SELECT courseID FROM wants_to_study WHERE stdID = $_SESSION[id])");
              if(mysqli_num_rows($result) == 0){
              	echo "<tr><td colspan=3>No record found!</td></tr>";
              }
              while ($row = $result->fetch_assoc())
              {
                echo "<tr>";
                foreach($row as $value) echo "<td>$value</td>";
                echo "<td><i class='fa fa-plus' aria-hidden='true' title='Add'></i></td>";
                echo "</tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>

  </div>

<?php
$con->close();
?>

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
<script type="text/javascript"></script>

</body>
</html>