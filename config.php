<?php

  $servername = "localhost";
  $db_username = "root";
  $db_password = "";
  $database = "webProject";


  $conn = new mysqli($servername,$db_username,$db_password,$database);

  if($conn->connect_error){
      die("connection failed: " . $conn->connect_error);
  }
?>