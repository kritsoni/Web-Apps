<?php
$un =$_POST["user"];
$con = new mysqli("localhost","phpmyadmin","root","registration_db");
if($con->connect_error){
    die("connection failed to establish");
}
$sql="SELECT * FROM reg WHERE USERNAME='$un'";
$r=$con->query($sql);
if($r->num_rows> 0){
    $ret[0]="ALREADY EXISTS";             
    }
else{
    $ret[0]="";
    }
    $count=0;
    $len1=strlen($un);
    $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*^';
    $len2 = strlen($charset);
    $user_random="";
    while($count<=3){
        $len3=rand(1,10);
        $user_random =$un;
       for ($i = 0; $i < $len3; $i++) {
           $ran= $charset[rand(0,$len2-1)];
           $user_random.=$ran;
    }
    $sql="SELECT * FROM reg WHERE USERNAME='$user_random'";
    $r=$con->query($sql);
    if($r->num_rows> 0){
      continue;    
    }
    else{
        $count++;
        $ret[$count]=$user_random;
        }
            
}
echo json_encode($ret);
?>