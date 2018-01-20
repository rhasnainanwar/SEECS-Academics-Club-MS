<?php
include "init.php";  
  if ( count($_SESSION) == 0 ){
    header("Location: login.php"); /* Redirect browser */
    exit();
  }
  else if($_SESSION["type"] == "user"){
    header("Location: profile.php"); /* Redirect browser */
    exit();
  }

  include("fusioncharts.php");
?>
<!DOCTYPE html>
<html lang="en" class="gr__egrappler_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Welcome to SEECS Academics Club!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="./assets/dependencies/bootstrap.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="./assets/dependencies/font-awesome.css" rel="stylesheet">
<link href="./assets/css/style.css" rel="stylesheet">
<link href="./assets/css/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body data-post="" data-gr-c-s-loaded="true" style="">
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
        <li class="active"><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span> </a> </li>
        <li><a href="executives.php"><i class="fa fa-briefcase"></i><span>Executives</span> </a> </li>
        <li><a href="courses.php"><i class="fa fa-book"></i><span>Courses</span> </a> </li>
        <li><a href="mentors.php"><i class="fa fa-graduation-cap"></i><span>Mentors</span> </a></li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>This Week's Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <div id="big_stats" class="cf">
                    <?php
                    $result = mysqli_query($con,"SELECT COUNT(*) AS val FROM helpsession")->fetch_assoc();
                    echo "<div class='stat' title='Sessions'> <i class='fa fa-graduation-cap'></i> <span class='value'>$result[val]</span> </div>";

                    $result = mysqli_query($con,"SELECT COUNT(*) AS val FROM registers WHERE attended = true")->fetch_assoc();
                    echo "<div class='stat' title='Attendees'> <i class='fa fa-thumbs-o-up'></i> <span class='value'>$result[val]</span> </div>";

                    $result = mysqli_query($con,"SELECT COUNT(*) AS val FROM registers")->fetch_assoc();
                    echo "<div class='stat' title='Registrations'> <i class='fa fa-users'></i> <span class='value'>$result[val]</span> </div>";
                    ?>
                  </div>
                </div>
                <!-- /widget-content --> 
              </div>
            </div>
          </div>
          <div class="widget widget-nopad">
            <?php
            $result = mysqli_query($con,"SELECT count(*) AS menCount, course FROM can_teach GROUP BY course");
            if ($result) {

              // The `$arrData` array holds the chart attributes and data
              $arrData = array(
                    "chart" => array(
                        "caption" => "Mentor Count for Each Course",
                        "showValues"=> "0",
                        "theme"=> "zune"
                    )
                );

              $arrData["data"] = array();

      // Push the data into the array

              while($row = mysqli_fetch_array($result)) {
                array_push($arrData["data"], array(
                    "label" => $row["course"],
                    "value" => $row["menCount"]
                    )
                );
              }

              /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

              #$jsonEncodedData = json_encode($arrData);
              $jsonEncodedData = json_encode($arrData);

              /*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

              $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

              // Render the chart
              $columnChart->render();
            }
           ?>
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts"><form class="sess" action="session.php" method="GET"><input type="text" name="cid" placeholder="Course ID"> <input type="submit" name="go" value="Create Session" class="btn btn-success"></form></div>
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Recent Suggestions</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
                <?php
                $result = mysqli_query($con,"SELECT monthname(ftime) AS month, dayofmonth(ftime) AS day, suggestions FROM feedback LIMIT 10");
                while ($row = $result->fetch_assoc())
                {
                  echo "
                  <li>
                  <div class='news-item-date'> <span class='news-item-day'>$row[day]</span> <span class='news-item-month'>$row[month]</span> </div>
                  <div class='news-item-detail'>
                    <p class='news-item-preview'>$row[suggestions]</p>
                  </div>
                </li>";
                }
                
                ?>
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
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
<script type="text/javascript" src="./assets/js/top-bar.js"></script>
<script type="text/javascript" src="./assets/js/bsa-ads.js"></script>
<script src="./assets/dependencies/bootstrap.js"></script>
<script src="./assets/js/fusioncharts.js" type="text/javascript"></script>
<script src="./assets/js/fusioncharts.charts.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="./assets/js/fullcalendar.min.js"></script>
<script src="./assets/js/base.js"></script>
</body>
</html>