<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="registration.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <script src="registration.js" > </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body>
         <div id="head"> REGISTRATION - FORM   </div>
         <div id="form">   
        <form name="info_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validation()">
        <div class="field">
            <span class="fields"> NAME:</span><br> 
            <input type="text" size="20" name="na" value='<?php if(isset($_POST["na"])) echo $_POST["na"]; ?>' onkeyup="fetch_name(this.value)" > 
        </div> 
        <div id="name_valid" class="inline"></div> <br>
        <div class="field">
            <span class="fields"> USERNAME:</span><br>
            <input type="text" size="20" name="a" id="aa" value='<?php if(isset($_POST["a"])) echo $_POST["a"]; ?>' onkeyup="fetch_username(this.value)" > 
            </div> 
        <div id="username_valid" class="inline in1"></div>     
        <div id="choices">
       </div>  <br>
        <div class="field">
            <span class="fields"> PASSWORD:</span><br> 
            <input type="password" size="20"name="pa" onkeyup="fetch_password(this.value)">
        </div>
         <div id="pass_valid" class="inline"></div>  <br>
         <div class="field">
            <span class="fields">CONFIRM PASSWORD:</span><br> 
            <input type="password" size="20"name="pc" onkeyup="fetch_passwordc(this.value)">
        </div>
         <div id="pass_cnf" class="inline"></div>  <br>
         
        <div class="field">
            <span class="fields"> MOBILE NO:</span><br> 
            <input type="text" name="mno" value='<?php if(isset($_POST["mno"])) echo $_POST["mno"]; ?>' onkeyup="fetch_mno(this.value)" >
        </div>
        <div id="mno_valid" class="inline"></div>  <br>
        <div class="field">
            <span class="fields">GENDER :-</span>
            <span class="fields">MALE</span>
            <input type="radio" name="gender" value="male" checked id="m">
            <span class="fields">FEMALE</span> 
            <input type="radio" name="gender" value="female" id="f">
        </div><br>
        <div class="field">
             <span class="fields">BIRTHDATE:</span><br>
             <input type="date" name="bday" value='<?php if(isset($_POST["bay"])) echo $_POST["bday"]; ?>' onkeyup="fetch_date(this.value)" >
        </div>
        <div id="bday_valid" class="inline in1"></div> <br>  
        <div class="field"> 
            <span class="fields">ADDRESS:</span><br>
            <input type="text" name="addr" value='<?php if(isset($_POST["addr"])) echo $_POST["addr"];?>' onkeyup="fetch_addr(this.value)" >
        </div> 
            <div id="addr_valid" class="inline in2 "></div> 
            <br>
        <div class="field">
        <span class="fields">COUNTRY:</span>
        <select name="country" onchange="fetch_city(this.value)">   
           <option selected value="not_select">select a country </option>       
        <?php        
        $json=file_get_contents('countries_only.json');
        $list=json_decode($json, true);
        foreach($list as $key=>$val)
            echo "<option>$val</option>";           
        ?>    
        </select>   
        </div>
        <div id="country_valid" class="inline in3"></div> <br>
        <div class="field">
        <span class="fields">STATE:</span>
        <select name="state" onchange="fetch_state(this.value)" >   
           <option selected value="not_select">select a city </option>
             
           </select>   
        </div>
        <div id="state_valid" class="inline in3"></div> <br>     
        <div class="field">
            <span class="fields">EMAIL:</span><br>
            <input type="email"size="40" name="mail" value='<?php if(isset($_POST["mail"])) echo $_POST["mail"]; ?>' onkeyup="fetch_email(this.value)">
         </div> 
         <div id="email_valid" class="inline in3"></div> <br>
     <input type="submit" value="REGISTER" id="btn" >
            </form>
         </div>                  
    </body>
</html>
<?php 
   if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $con = new mysqli("localhost","phpmyadmin","root","registration_db");
    if($con->connect_error){
        die("connection failed to establish");
    }
     $un=$_POST['a'];
     $n=$_POST['na'];
     $p=$_POST['pa'];
     $m=$_POST['mno'];
     $g=$_POST['gender'];
     $b=$_POST['bday'];
     $a=$_POST['addr'];
     $ma=$_POST['mail'];
     $country=$_POST['country'];
     $state=$_POST['state'];     
     $sql="SELECT * FROM reg WHERE USERNAME='$un'";
     $r=$con->query($sql);
     if($r->num_rows> 0){
         echo '<script> document.getElementById("username_valid").innerHTML="ALREADY EXISTS"; </script>';             
         }
    else{
      $sql = "INSERT INTO reg 
            Values('$un','$n','$p','$m','$g','$b','$a','$country','$state','$ma')";
      $con->query($sql);
     
     echo '<script>
     alert("REGISTERED SUCCESFULLY"); 
   </script>';
         echo '<script>document.forms["info_form"]["na"].value="";</script>';     
         echo '<script>document.forms["info_form"]["a"].value="";</script>';
         echo '<script>document.forms["info_form"]["pa"].value="";</script>';
         echo '<script>document.forms["info_form"]["pc"].value="";</script>';
         echo '<script>document.forms["info_form"]["mno"].value="";</script>';
         echo '<script>  if(document.getElementById("m").checked) 
               document.getElementById("m").checked= false;</script>';
         echo '<script>   if(document.getElementById("f").checked)
            document.getElementById("f").checked= false;</script>';
         echo '<script>   document.forms["info_form"]["bday"].value="";</script>';
         echo '<script>  document.forms["info_form"]["addr"].value="";</script>';
         echo '<script> document.forms["info_form"]["mail"].value="";</script>';    
 
    }
    $con->close();
}
?>
