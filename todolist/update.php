<?php

 $res =json_decode($_POST['updt']);
  $titles=$res[0];
  for($i=0;$i<sizeof($res[1]);$i++)
    $descs[$i]=$res[1][$i];      
  $dat=$res[2];
  $pri=$res[3];
  $ts=$res[4];
  $titles= join("~!#",$titles);
  $descs= join("~!#",$descs);
  $con = new mysqli("localhost","phpmyadmin","root","todo");
  if($con->connect_error){
      die("connection failed to establish");
  }
  $sql =  "UPDATE to_do
           set TITLE='$titles',DATE='$dat',PRIORITY='$pri',DESCRIPTION='$descs'
           WHERE TIME='$ts'";
  $con->query($sql);
  $con->close();           

?>