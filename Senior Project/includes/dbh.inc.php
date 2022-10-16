<?php

$serverName = "goplay.local";
$dBUserName = "root";
$dBPassword = "";
$dBName = "goPlayDB";


$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}