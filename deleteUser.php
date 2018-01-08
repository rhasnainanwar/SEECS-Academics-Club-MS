<?php
 session_start();

 if ( count($_SESSION) == 0){
  header("Location: login.php"); /* Redirect browser */
  exit();
 }
 
 $con = new mysqli('127.0.0.1', 'root', '', 'cogman');
 if ($con->connect_error) {
    die('Connect Error (' . $con->connect_errno . ') ');
 }

 mysqli_query($con, "DELETE FROM user WHERE user.reg=$_SESSION[id]");
 mysqli_query($con, "DELETE FROM mentor WHERE mentor.id=$_SESSION[id]");
 mysqli_query($con, "DELETE FROM executive WHERE executive.id=$_SESSION[id]");

 session_unset();
 session_destroy();
 header("Location: login.php"); /* Redirect browser */
 exit();
?>