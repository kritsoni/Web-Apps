<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <script src="login.js" > </script>   
</head>
<body>
    <div id="head"> LOGIN - FORM   </div>   
    <form name="info_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="field">
        <span class="fields"> USERNAME:</span><br>
        <input type="text" size="30" name="a"  > 
    </div> 
    <div id="username_valid" class="inline"></div> <br>      
    <div class="field">
        <span class="fields"> PASSWORD:</span><br> 
        <input type="password" size="30"name="pa" >
    </div>
     <div id="pass_valid" class="inline"></div>  <br>
     <button type="submit" id ="btn" onclick="return validation()">submit</button>
   </form>
</body>
</html>



<?php
$un=$_POST['a'];
$ps=$_POST['pa'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && $un!="" && $ps!="" ) {
    
    $con = new mysqli("localhost","phpmyadmin","root","registration_db");
    if($con->connect_error){
        die("connection failed to establish");
    }
    $sql="SELECT * FROM reg WHERE USERNAME='$un' and PASSWORD='$ps'";
    $r=$con->query($sql);
    if($r->num_rows>0){
          echo "<p>SUCCESFULLY LOGGED IN</p>";
        }
   
    else{
        echo "<p>USERNAME DOES NOT EXISTS OR INVALID PASSWORD</p>";
    }    
  $con->close();
}

?>