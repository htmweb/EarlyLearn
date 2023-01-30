<?php
  $db = "stu_data";
  $server= "localhost";

  $con = mysqli_connect($server,"root","",$db);
  if(!$con){
  	die("Connection Failed...");
  }
?>