<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Welcome to SEECS Academics Club!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="./assets/dependencies/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/style.css" rel="stylesheet">
<link href="./assets/dependencies/font-awesome.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<?php
$con = new mysqli('127.0.0.1', 'root', '', 'cogman');
if ($con->connect_error) {
    die('Connect Error (' . $con->connect_errno . ')');
}
?>
<body data-post="" data-gr-c-s-loaded="true">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.php">SEECS Academics Club </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
			<li class="dropdown">						
				<a href="shortcodes.html#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-user"></i> 
					Admin
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
        <li class="active"><a href="mentors.php"><i class="fa fa-graduation-cap"></i><span>Mentors</span> </a></li>
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

<div class="container">
	<form method="POST" action="mentors.php">
		<div class="field">
			<h4>Residence:</h4>
			<input type="radio" name="residence" value="D"> Day Scholar 
			<input type="radio" name="residence" value="H"> Hostel-lite 
		</div>
		<div class="field">
			<h4>Department:</h4>
			<input type="checkbox" name="dept[]" value="CS"> Computer Science 
			<input type="checkbox" name="dept[]" value="SE"> Software Engineering 
			<input type="checkbox" name="dept[]" value="EE"> Electrical Engineering
			<input type="checkbox" name="dept[]" value="MATH"> Mathematics
			<input type="checkbox" name="dept[]" value="BSH"> Basic Sciences &amp; Humanities 
		</div>
		<div class="field">
			<h4>Rating Sort:</h4>
			<input type="radio" name="sort" value="ASC"> Ascending 
			<input type="radio" name="sort" value="DESC"> Descending
		</div>
			<input type="submit" name="filter" value="Filter"  class="button btn btn-success btn-large pull-right">
	</form>

    <div class="row">
    <?php
	   if(isset($_POST["delete"])){
			if(mysqli_query($con, "DELETE FROM can_teach WHERE mentorID='$_COOKIE[id]' AND course='$_COOKIE[cid]'"))
				$response = "<div class='alert alert-danger'><strong>$_COOKIE[name] deleted from $_COOKIE[cid]!</strong></div>";
		}

		if(isset($response)){
			echo $response;
		}

	?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Mentors &amp; Courses
            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
              <i class="fa fa-filter"></i>
            </span>
          </h3>
        </div>
        <div class="panel-body" style="display: none;">
          <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search" />
        </div>
        <table class="table table-hover" id="dev-table">
          <thead>
            <tr>
      			<th>Registration</th>
      			<th>Mentor Name</th>
      			<th>Email</th>
      			<th>Phone</th>
      			<th>D/H</th>
      			<th>Course #</th>
      			<th>Course</th>
      			<th>Topics</th>
      			<th>Rating</th>
           	</tr>
          </thead>
          <tbody>
          <?php
        	$query = "SELECT reg, CONCAT(fname, ' ' ,lname), email, cellno, residence, course.id, cname, strength, can_teach.rating FROM user JOIN mentor ON user.reg = mentor.id JOIN can_teach ON mentor.id = can_teach.mentorID JOIN course ON can_teach.course = course.id";

          	if(isset($_POST["filter"])){
	     		$dep = !empty($_POST["dept"]);

	     		if($dep){
		          	$conditions = " WHERE dept IN (";

		          	foreach ($_POST["dept"] as $selected) {
		          		$conditions .= "'$selected',";
		          	}

		          	$conditions = rtrim($conditions,',');
		          	$conditions .= ")";
				}

	          	if(isset($_POST["residence"]) && $dep)
	          		$conditions .= " AND residence = '$_POST[residence]'";
	          	else if(isset($_POST["residence"]))
	          		$conditions = " WHERE residence = '$_POST[residence]'";

	          	if(isset($conditions))
	          		$query .= $conditions;


	          	if(isset($_POST["sort"]))
	          		$query .= " ORDER BY rating $_POST[sort]";
          	}

            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) == 0){
            	echo "<tr><td colspan=3>No record found!</td></tr>";
            }
            while ($row = $result->fetch_assoc())
            {
              echo "<tr>";
              foreach($row as $value)
                if($value)
                  echo "<td>$value</td>";
                else
                  echo "<td>N/A</td>";
              echo "<td><i class='fa fa-minus-circle' aria-hidden='true' title='Delete'></i></td>";
              echo "</tr>";
            }
          ?>
          </tbody>
        </table>
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
<script type="text/javascript">

</body>
</html>