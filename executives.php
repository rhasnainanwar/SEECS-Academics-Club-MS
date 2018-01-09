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
        <li class="active"><a href="executives.php"><i class="fa fa-briefcase"></i><span>Executives</span> </a> </li>
        <li><a href="courses.php"><i class="fa fa-book"></i><span>Courses</span> </a> </li>
        <li><a href="mentors.php"><i class="fa fa-graduation-cap"></i><span>Mentors</span> </a></li>
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
    <form action="executives.php" method="post">
    
      <h1>Add Executives</h1>   
      
      <div class="login-fields">
        
        <div class="field">
          <label for="reg">Registration ID</label>
          <input type="text" id="reg" name="reg" placeholder="Registration ID" required="true">
        </div>

        <div class="field">
			<label for="role" class="select">Role:</label>
			<select class="form-control" id="role" name="role" required>
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
        <input type="submit" name="add" value="Add" class="button btn btn-success btn-large">
    </form>
    
  </div> <!-- /content -->
  <?php
	if(isset($_POST['add'])){
		$sql = "INSERT INTO executive (id, role) VALUES ($_POST[reg],'$_POST[role]')";
		$result = mysqli_query($con, "SELECT reg FROM user WHERE reg=$_POST[reg]");
		if(mysqli_num_rows($result) == 0){
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> User does not exist.</div>";
		}
		else if(mysqli_query($con,$sql)){
			$response = "<div class='alert alert-success'><strong>Success!</strong> ".$_POST["role"]." has been added.</div>";
		}
		else {
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> Kindly check if the executive record already exists.</div>";
		}
	}

	else if(isset($_POST['edit'])){
		$sql = "UPDATE executive SET id = $_POST[cid], role = '$_POST[role]' WHERE id = $_COOKIE[id]";
		$result = mysqli_query($con, "SELECT reg FROM user WHERE reg = $_POST[cid]");
		if(mysqli_num_rows($result) == 0){
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> User does not exist.</div>";
		}
		else if(mysqli_query($con,$sql)){
			$response = "<div class='alert alert-success'><strong>Success!</strong> ".$_POST["role"]." has been ddited.</div>";
		} else {
			$response = "<div class='alert alert-danger'><strong>Entry failed!</strong> Kindly check if the record already exists.</div>";
		}
	}

	else if(isset($_POST["delete"])){
		if(mysqli_query($con, "DELETE FROM executive WHERE id=$_COOKIE[id]"))
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
            <h3 class="panel-title">Executives 
              <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                <i class="fa fa-filter"></i>
              </span>
            </h3>
          </div>
          <div class="panel-body" style="display: none;">
            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Executives" />
          </div>
          <table class="table table-hover" id="dev-table">
            <thead>
              	<tr>
                <th>Registration</th>
      			<th>Name</th>
      			<th>Email</th>
      			<th>Phone</th>
      			<th>Batch</th>
      			<th>D/H</th>
      			<th>Role</th>
             	</tr>
            </thead>
            <tbody>
            <?php
              $result = mysqli_query($con,"SELECT reg, CONCAT(fname, lname), email, cellno, batch, residence, role FROM user JOIN executive ON reg = id");
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form action="executives.php" method="post">	        
	        <div class="field">
	          <label for="cid">Registration ID</label>
	          <input type="text" id="cid" name="cid" placeholder="Registration ID" required="true">
	        </div>

	        <div class="field">
				<label for="role" class="select">Role:</label>
				<select class="form-control" id="role" name="role" required>
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
	        
	        <input type="submit" name="edit" value="Edit" class="button btn btn-success btn-large">
	    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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