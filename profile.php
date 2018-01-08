<?php
	session_start();
	$con = new mysqli('127.0.0.1', 'root', '', 'cogman');
	if ($con->connect_error) {
	    die('Connect Error (' . $con->connect_errno . ') ');
	}
	$query = "SELECT reg, CONCAT(fname, ' ' ,lname) AS name, email, cellno, residence, batch FROM user WHERE email = '$_SESSION[email]'";
	$result = mysqli_query($con, $query)->fetch_assoc();

	if ( count($_SESSION) == 0 ){
	  header("Location: login.php"); /* Redirect browser */
	  exit();
	}
	else if (!$result){
	  header("Location: index.php"); /* Redirect browser */
	  exit();
	}

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
				<a href="shortcodes.html#" class="dropdown-toggle" data-toggle="dropdown">
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
                <button data-original-title="Delte my account" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-minus-circle"></i></button>
            </span>
        	</div>
        	<a href="#" class="btn btn-primary">My Sales Performance</a>
            <a href="#" class="btn btn-primary">Team Sales Performance</a><br><br>
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
<script type="text/javascript"></script>

</body>
</html>