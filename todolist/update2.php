<?php

 $res =json_decode($_POST['upd']);
  $titles=$res[0];
  for($i=0;$i<sizeof($res[1]);$i++)
    $descs[$i]=$res[1][$i];      
  $dat=$res[2];
  $pri=$res[3];
  $titles= join("~!#",$titles);
  $descs= join("~!#",$descs);
  $con = new mysqli("localhost","root","root","todo");
  if($con->connect_error){
      die("connection failed to establish");
  }
  $sql =  "INSERT INTO to_do(TITLE,DATE,PRIORITY,DESCRIPTION)
           VALUES('$titles','$dat','$pri','$descs')";

  $con->query($sql);
  $con->close();           

?>