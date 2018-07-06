<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO-LIST</title>
    <link rel="stylesheet" type="text/css" href="todolist1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="todolist1.js"></script>
</head>
<body>
    
<header id="header" >
    <h1 id="h1">  TO DO LIST  </h1>
<section id="nav">
      <div id="input"> 
     <span id="c">CREATE: </span>
     <button id="plus">+</button>   
     </div>
   
   
     <section id="sea">  
     <span>SEARCH: </span> 
     <input type="text" onkeyup='search(this.value)' id="search" style="border-radius:10px" autocomplete="off">   
     </section>
     <img src="help.png" id="tutorial" style="width:50px;height:50px;position:relative;left:1400px">
     
   <div id="b"> <button id="menu">&#9776;</button> </div>
</section>
<div id="help">

</div>   
   <div id="mi">
         <p class="mii" >COMPLETED OR SHOULD HAVE BEEN COMPLETED</p>
         <p class="mii" >VERY-IMPORTANT</p>
         <p class="mii" >IMPORTANT</p>
         <p class="mii" >NORMAL</p>
         <p class="mii" >BY DATE</p>
         <p class="mii" >TODAY`S TASKS</p>
         <p class="mii" >ALL TASKS</p>  
     </div>
 </header>     
     <div id="results">
     <span id="cr" style="position:relative;left:10px;top:20px">&times;</span>
     </div>
     <section id="staticnotes">
     <span id="cro" style="position:relative;left:10px;top:20px">&times;</span>
     <div id="bignotes"> 
     </div>
     </section>
     <div id="back">
     <span onclick="document.getElementById('popup').style.display='none'" id="cross" style="position:relative;left:350px;top:80px">&times;</span>
    
        <div id="popup">
            <form id="det" name="info_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                  <input type="text" name="tit[]" id="title" placeholder="TITLE" required
                    style="width:690px;height:30px;border:.25px dashed;margin-bottom:15px"><br>
                  <textarea  rows="6" cols="40" name="desc[]" required placeholder="DESCRIPTION"
                  style="width:685px;height:90px;border:.25px dashed"></textarea><br>
                  <div id="lists">
                         
                   </div>                 
                  <button id="add" style="width:40px;height:40px">+</button><br> 
                  <span style="position:relative;top:25px">TASK-DATE: </span>
                  <input type="date" name="date" id="da" style="position:relative;top:25px"><br>
                  <span style="position:relative;left:450px;font-size:20px">PRIORITY: </span>
                   <select class="details" id="selectlist" name="priori"style="position:relative;float:right" >
                       <option>NORMAL</option>
                       <option>IMPORTANT</option>
                       <option>VERY-IMPORTANT</option>
                   </select><br>                    
                   <input type="submit" id="frmsub" class="details" style="width:70px;height:40px;position:relative;left:290px;top:20px">             
            </form> 
       </div>
    </div> 
</body>
</html>
<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $titles=$_POST["tit"];
    $descs=$_POST["desc"];    
    $dat=$_POST["date"];
    $pri=$_POST['priori'];
    $titles= join("~!#",$titles);
    $descs= join("~!#",$descs);
    $con = new mysqli("localhost","phpmyadmin","root","todo");
    if($con->connect_error){
        die("connection failed to establish");
    }
    $sql = "INSERT INTO to_do(TITLE,DATE,PRIORITY,DESCRIPTION)
             VALUES('$titles','$dat','$pri','$descs')";
    $con->query($sql);
    $con->close();           
}
?>
