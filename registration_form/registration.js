function validation(){
var b1=name();
var b2=username();
var b3=password();
var b4=confirmpass();
var b5=mobileno();
var b6=date_valid();
var b7=addr();
var b8=email_valid();
var b9=country();
var b10=state();
if(b1&&b2&&b3&&b4&&b5&&b6&&b7&&b8&&b9&&b10)
  return true;
  else 
    return false;     
}

function name(){
  var name,pat1 = /^[A-Za-z ]+$/;
  name = document.forms["info_form"]["na"].value;
  if(name ==""){
    document.getElementById("name_valid").innerHTML="name is required";
    return false;    
  }
  else if(!pat1.test(name)){  
    document.getElementById("name_valid").innerHTML="invalid name";
    return false;}
  else{
    document.getElementById("name_valid").innerHTML="";
    return true;
  }
    
}
function username(){
  var name,pat1 =/^[0-9]+$/;
  name = document.forms["info_form"]["a"].value;
  if(name ==""){
    document.getElementById("username_valid").innerHTML="username is required";
    return false;    
  }
  else if(pat1.test(name)){  
    var msg=document.getElementById("username_valid");
    msg.style.position="relative";
    msg.style.right="-55px";   
    document.getElementById("username_valid").innerHTML="username should not have only digits";
    return false;}
  else if(name.length< 6){
    document.getElementById("username_valid").innerHTML="too short(minlen 6)";
    return false;  
  }
  else if(user!=""){
    document.getElementById("username_valid").innerHTML="ALREADY EXISTS";
    return false;  
  }   
  else{
    document.getElementById("username_valid").innerHTML="";
    return true;
  }
    
}


function password(){
  var pass,pat1=/[^a-zA-Z0-9]+/;
  pass = document.forms["info_form"]["pa"].value;
   if(pass == ""){
     document.getElementById("pass_valid").innerHTML="password is required";
     return false;    
      }
   else if(pass.length<8){  
      document.getElementById("pass_valid").innerHTML="too short(minlen 8)";
      return false;}
  
    else if(!pat1.test(pass)){
      var msg=document.getElementById("pass_valid");
      msg.style.position="relative";
      msg.style.right="-70px";
      document.getElementById("pass_valid").innerHTML="must contain atleast 1special symbol";
      return false;
  }
   else{
    document.getElementById("pass_valid").innerHTML="";
    return true;
   }
}

function confirmpass(){
  var pass1,pass2;
  pass1 = document.forms["info_form"]["pa"].value;
  pass2 = document.forms["info_form"]["pc"].value;
  if(pass2 == ""){
    document.getElementById("pass_cnf").innerHTML="this is required";
    return false;     
  }
  if(pass1 !== pass2){
    var msg=document.getElementById("pass_cnf");
    msg.style.position="relative";
    msg.style.right="-90px"; 
    document.getElementById("pass_cnf").innerHTML="passwords do not match";
    return false;   
  }
  else{
    document.getElementById("pass_cnf").innerHTML="";
    return true;     
  }
}
function mobileno(){
  var m,pat=/^[0-9]+$/;
  m = document.forms["info_form"]["mno"].value;
   if(m == ""){
     document.getElementById("mno_valid").innerHTML="mobile no is required";
     return false;    
      }
   if(!pat.test(m)){
    var msg=document.getElementById("mno_valid");
    msg.style.position="relative";
    msg.style.right="-116px";
    document.getElementById("mno_valid").innerHTML="mobile no contains only digits";
    return false;       
   }   
   else if(m.length!=10){  
      var msg=document.getElementById("mno_valid");
      msg.style.position="relative";
      msg.style.right="-70px";
      document.getElementById("mno_valid").innerHTML="mobile no can be only of 10 digits";
      return false;}
   else{
        document.getElementById("mno_valid").innerHTML="";
        return true;
   }      

}

function date_valid(){
  var d;
  d = document.forms["info_form"]["bday"].value;
   if(d ==""){
     document.getElementById("bday_valid").innerHTML="every field of date is required";
     return false;    
      }
   
   else{
        document.getElementById("bday_valid").innerHTML="";
        return true;
   }      
}

function addr(){
  var ad,pat1=/^[0-9]+$/,pat2=/^[A-Za-z ]+$/;
  ad = document.forms["info_form"]["addr"].value;
   if(ad == ""){
     document.getElementById("addr_valid").innerHTML="address  is required";
     return false;    
      }    
   else if(pat1.test(ad)){ 
    var msg=document.getElementById("addr_valid");
    msg.style.position="relative";
    msg.style.right="-116px";
      document.getElementById("addr_valid").innerHTML="address cannot be only of digits";
      return false;}
   else if(pat2.test(ad)){
    var msg=document.getElementById("addr_valid");
    msg.style.position="relative";
    msg.style.right="-60px";  
        document.getElementById("addr_valid").innerHTML="address should contain apartment no";
        return false;}
    else{
      document.getElementById("addr_valid").innerHTML="";
      return true;
    }
   }      

function email_valid(){
  var mail,pat1 = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  mail = document.forms["info_form"]["mail"].value;
  if(mail ==""){
    document.getElementById("email_valid").innerHTML="email is required";
    return false;    
  }
  else if(!pat1.test(mail)){  
    document.getElementById("email_valid").innerHTML="invalid email";
    return false;}
  else{
    document.getElementById("email_valid").innerHTML="";
    return true;
  }

}
function country(){
  var con=document.forms["info_form"]["country"].value;

   if(con=="not_select"){
    document.getElementById("country_valid").innerHTML="*Required";
    return false;
  }
  else{
    document.getElementById("country_valid").innerHTML="";
    return true;  
  }
      
}
function state(){
  var con=document.forms["info_form"]["state"].value;

  if(con=="not_select"){
   document.getElementById("state_valid").innerHTML="*Required";
   return false;
 }
 else{
   document.getElementById("state_valid").innerHTML="";
   return true;  
 }

}
function fetch_city(value){   
  country();     
   var Req = new XMLHttpRequest();
   var c,str="<option selected value='not_select'>select a city </option>"; 
   Req.onload = function() {
     c=JSON.parse(this.responseText);
     for(x in c){
    if(x == value){
       var len=c[x].length; 
       var y= document.getElementsByName("state")[0];
       for(z=0;z<len;z++){
           str+="<option>"+c[x][z]+"</option>";
       }
                               
        y.innerHTML=str;                       
    }
}
};
 Req.open("get", "demo.php", true);
 Req.send();
}
function fetch_state(value){
      state();
}
function fetch_name(value){
    name();
}
   function fetch_username(value){
    $("#choices").empty();     
   user="";
   var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       arr=JSON.parse(this.responseText);
       if(arr[0]!=""){ 
           user=arr[0];
       
           document.getElementById("username_valid").innerHTML=arr[0];
           var i1 = document.createElement("input");
           var i2 = document.createElement("input");
           var i3 = document.createElement("input");
           var v1 = document.createTextNode(arr[1]);
           var v2 = document.createTextNode(arr[2]);
           var v3 = document.createTextNode(arr[3]);
           var s1 = document.createElement("span");
           var s2 = document.createElement("span");
           var s3 = document.createElement("span");
           var s4 = document.createElement("span");
           var s5 = document.createElement("span");
           var s6 = document.createElement("span");        
           var p1 = document.createElement("br");
           var p2 = document.createElement("br");
           i1.type="radio";
           i1.name="choice";
           i1.value=arr[1];
           i1.addEventListener("click",value);
           i1.id="ch1";
           i2.type="radio";
           i2.name="choice";
           i2.value=arr[2];
           i2.addEventListener("click",value);
           i2.id="ch2";
           i3.type="radio";
           i3.name="choice";
           i3.value=arr[3];
           i3.addEventListener("click",value);
           i3.id="ch3";
           s1.innerHTML="1st";
           s1.id="s1";
           s2.innerHTML="2nd";
           s2.id="s2";
           s3.innerHTML="3rd";
           s3.id="s3";
           p1.id="p1";
           p2.id="p2";
           s4.id="v1";
           s5.id="v2";
           s6.id="v3";
           var div=document.getElementById("choices"); 
           s4.appendChild(v1);
           s5.appendChild(v2);
           s6.appendChild(v3);                                      
           div.appendChild(s1);
           div.appendChild(i1);
           div.appendChild(s4);   
           div.appendChild(p1);
           div.appendChild(s2);
           div.appendChild(i2);
           div.appendChild(s5);
           div.appendChild(p2);
           div.appendChild(s3);
           div.appendChild(i3);
           div.appendChild(s6);
           function value(){
             var sz1 = document.getElementById('ch1');
             var sz2= document.getElementById('ch2');
             var sz3 = document.getElementById('ch3');
             var sz=[sz1,sz2,sz3];
             for (var i=0, len=sz.length; i<len; i++) {
             if(sz[i].checked){
              document.getElementById('aa').value = sz[i].value;
              var div=document.getElementById("choices");                        
              $('#choices').empty();
              document.getElementById("username_valid").innerHTML="";

 } 
       }
}
   }
          else{
         username();
          }
       }   
 
       };
  xhttp.open("POST", "userexists.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("user="+value);
}       
function fetch_password(value){
   password();
}
function fetch_passwordc(value){
   confirmpass();
}
function fetch_mno(value){
   mobileno();
}

function fetch_date(value){
   date_valid();
}

function fetch_addr(value){
   addr();  
}
function fetch_email(value){  
  email_valid();
}
