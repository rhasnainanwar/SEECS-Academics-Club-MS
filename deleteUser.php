<?php
include "init.php";

 if ( count($_SESSION) == 0){
  header("Location: login.php"); /* Redirect browser */
  exit();
 }

 mysqli_query($con, "DELETE FROM user WHERE user.reg=$_SESSION[id]");
 mysqli_query($con, "DELETE FROM can_teach WHERE mentorID = $_SESSION[id]");
 mysqli_query($con, "DELETE FROM wants_to_study WHERE stdID = $_SESSION[id]");
 mysqli_query($con, "DELETE FROM mentor WHERE mentor.id=$_SESSION[id]");
 mysqli_query($con, "DELETE FROM executive WHERE executive.id=$_SESSION[id]");

 session_unset();
 session_destroy();
 header("Location: login.php"); /* Redirect browser */
 exit();
?>