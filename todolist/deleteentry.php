<?php

$txt = $_POST['del'];
$pos = strpos($txt,"created-on:-");
$pos+=12;
$str=substr($txt,$pos,19);
$con = new mysqli("localhost","phpmyadmin","root","todo");
if($con->connect_error){
    die("connection failed to establish");
}
$sql="DELETE FROM to_do WHERE TIME='$str'";
$r=$con->query($sql);
$con->close();
?>
