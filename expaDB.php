<?php
$mysqli = new mysqli("SERVER","USR","PWD","TABLE");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>