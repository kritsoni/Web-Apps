<?php
   $arr=[];
   $arr1=[];
   $arr2=[];
   $arr3=[];
   $arr4=[];
   $arr5=[];
   $counter=0;
   $value=$_POST["val"];
   $con = new mysqli("localhost","phpmyadmin","root","todo");
   if($con->connect_error){
       die("connection failed to establish");
   }
   if($value =="ALL TASKS"){
    $sql =  "SELECT * FROM `to_do` ";
    $r=$con->query($sql);
    if($r->num_rows > 0) {
     while($row = $r->fetch_assoc()) {
          $arr1[$counter]=$row["TIME"];
          $arr2[$counter]=$row["TITLE"];
          $arr3[$counter]=$row["DATE"];
          $arr4[$counter]=$row["PRIORITY"];
          $arr5[$counter]=$row["DESCRIPTION"];
          $counter++;
     }
     $arr=[$arr1,$arr2,$arr3,$arr4,$arr5];
   }  
  else {
     $arr=[];
 }
 echo json_encode($arr);     
   
   }

else if($value =="COMPLETED OR SHOULD HAVE BEEN COMPLETED"){
    $sql =  "SELECT * FROM `to_do` WHERE DATE<DATE(NOW()) ORDER BY DATE ASC";
    $r=$con->query($sql);
    if($r->num_rows > 0) {
     while($row = $r->fetch_assoc()) {
          $arr1[$counter]=$row["TIME"];
          $arr2[$counter]=$row["TITLE"];
          $arr3[$counter]=$row["DATE"];
          $arr4[$counter]=$row["PRIORITY"];
          $arr5[$counter]=$row["DESCRIPTION"];
          $counter++;
     }
     $arr=[$arr1,$arr2,$arr3,$arr4,$arr5];
   }  
  else {
     $arr=[];
 }
 echo json_encode($arr);     
   
   }
   else if($value == "TODAY`S TASKS"){
    $sql = "SELECT * FROM `to_do` WHERE DATE=DATE(NOW())";
    $r=$con->query($sql);
    if($r->num_rows > 0) {
     while($row = $r->fetch_assoc()) {
          $arr1[$counter]=$row["TIME"];
          $arr2[$counter]=$row["TITLE"];
          $arr3[$counter]=$row["DATE"];
          $arr4[$counter]=$row["PRIORITY"];
          $arr5[$counter]=$row["DESCRIPTION"];
          $counter++;
     }
     $arr=[$arr1,$arr2,$arr3,$arr4,$arr5];
   }  
  else {
     $arr=[];
 }
 echo json_encode($arr);     
   }
   else if($value == "BY DATE"){
    $sql ="SELECT * FROM to_do ORDER BY DATE ASC";
    $r=$con->query($sql);
    if($r->num_rows > 0) {
     while($row = $r->fetch_assoc()) {
          $arr1[$counter]=$row["TIME"];
          $arr2[$counter]=$row["TITLE"];
          $arr3[$counter]=$row["DATE"];
          $arr4[$counter]=$row["PRIORITY"];
          $arr5[$counter]=$row["DESCRIPTION"];
          $counter++;
     }
     $arr=[$arr1,$arr2,$arr3,$arr4,$arr5];
   }  
  else {
     $arr=[];
 }
 echo json_encode($arr);   
   }
   else{
   $sql="SELECT * FROM to_do WHERE PRIORITY='$value'";
   $r=$con->query($sql);
   if($r->num_rows > 0) {
    while($row = $r->fetch_assoc()) {
         $arr1[$counter]=$row["TIME"];
         $arr2[$counter]=$row["TITLE"];
         $arr3[$counter]=$row["DATE"];
         $arr4[$counter]=$row["PRIORITY"];
         $arr5[$counter]=$row["DESCRIPTION"];
         $counter++;
    }
    $arr=[$arr1,$arr2,$arr3,$arr4,$arr5];
  }  
 else {
    $arr=[];
}
echo json_encode($arr);
   }
$con->close();
?>
