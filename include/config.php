<?php
ob_start();
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'redstore','3308');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


