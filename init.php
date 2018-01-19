<?php
session_start();
#databse connection
  $con = new mysqli('127.0.0.1', 'root', '', 'cogman');
  if ($con->connect_error) {
      die('Connect Error (' . $con->connect_errno . ') ');
  }
?>