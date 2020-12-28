<?php
$con = mysqli_connect("localhost","root","") or die("DB not connected");
mysqli_select_db($con,"email") or die("DB not found");
?>