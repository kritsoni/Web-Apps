function validation(){
   var b1= username();
   var b2= password();
  if(b1&&b2)
    return true;
  else 
    return false;

}
function username(){
    var name;
    name = document.forms["info_form"]["a"].value;
    if(name ==""){
      document.getElementById("username_valid").innerHTML="username is required";
      return false;    
    }
    else{
      document.getElementById("username_valid").innerHTML="";
      return true;
    }
      
  }
  
  
  function password(){
    var pass;
    pass = document.forms["info_form"]["pa"].value;
     if(pass == ""){
       document.getElementById("pass_valid").innerHTML="password is required";
       return false;    
        }
     else{
      document.getElementById("pass_valid").innerHTML="";
      return true;
     }
  }
  
    