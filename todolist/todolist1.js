 var value="",value1="",value2="",value3="",value4="";
function search(val){
  $("#results").removeClass("disable").css('opacity','1');
  $("*").find('div').not("#results").css('opacity', '0.1').addClass("disable")      ;
  $("#cr").css({'display':'block'});
  $("#results").css({"display":"block"}).animate({width:'1750px',
  height:'750px',top:'200px'},"slow"); 
  var response,len1,len2,len3,tit,desc,div,chk,div1;
  var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        response=JSON.parse(this.responseText);
       
        $("#results div").remove();
         if(response.length>0){
          len1=response[0].length;
          len2=response[1].length;
        var cnt1=0,cnt2=0,cnt3=0;
            while(cnt2<len2){
                if(response[1][cnt2].indexOf("~!#")>=0){
                  div=$("<div class='notes' name='notes[]'></div>");
                  div1=$("<div class='nt'></div>");                           
                  chk=$('<input type="checkbox" class="check" name="check[]"/>' );
                  chk.appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                 
                  cnt3=0;
                  tit=response[1][cnt2].split("~!#");
                   var pos1;

              for(pos1=0;pos1<tit.length;pos1++){
                 if(tit[pos1].indexOf(val)!=-1 ) {
                     var s="<span class='red'>"+val+"</span>";
                    tit[pos1]=tit[pos1].split(val).join(s);
                  }
                }
                        desc=response[4][cnt2].split("~!#");
                  len3=tit.length;
                  while(cnt3<len3){
                    $("<span class='in'></span>").text("TITLE:-").appendTo(div);
                    $('<p class="in"></p><br>').html(tit[cnt3]).appendTo(div);
                    $("<span class='in'></span>").text("DESCRIPTION:-").appendTo(div);                  
                    $('<p class="in"></p><br>').text(desc[cnt3]).appendTo(div);
                     cnt3++;           
                  }
                  $("<span class='in'></span>").text("DATE:-").appendTo(div);                    
                  $('<p class="in"></p><br>').text(response[2][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("PRIORITY:-").appendTo(div);                    
                  $('<p class="in"></p><br>').text(response[3][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("created-on:-").appendTo(div);                                      
                  $('<p class="in"></p><br>').text(response[0][cnt2]).appendTo(div);
                }
                else{
                  div=$("<div class='notes' name='notes[]'></div>");
                  div1=$("<div class='nt'></div>");                            
                  chk=$('<input type="checkbox" class="check" name="check[]"/>' );
                  chk.appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
           
                    if(response[1][cnt2].indexOf(val)!=-1 ) {
                        var s="<span class='red'>"+val+"</span>";
                        response[1][cnt2]=response[1][cnt2].split(val).join(s);
                     }
                      $("<span class='in'></span>").text("TITLE:-").appendTo(div);                   
                  $('<p class="in"></p><br>').html(response[1][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("DESCRIPTION:-").appendTo(div);                 
                  $('<p class="in"></p><br>').text(response[4][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("DATE:-").appendTo(div);                   
                  $('<p class="in"></p><br>').text(response[2][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("PRIORITY:-").appendTo(div);                    
                  $('<p class="in"></p><br>').text(response[3][cnt2]).appendTo(div); 
                  $("<span class='in'></span>").text("created-on:-").appendTo(div);             
                  $('<p class="in"></p><br>').text(response[0][cnt2]).appendTo(div);  
                }
               cnt2++;          
               div1.append(div);
               $("#results").append(div1);
        }
      }
      else{
        div=$("<div></div>").text("empty").css({"font-size":"100px","text-align":"center"});
        $("#results").append(div);
            }
         }
         $(".check").change(function(){
          if(this.checked){
            if (confirm("REMOVE THIS TASK ")) {
               var xhttpp = new XMLHttpRequest();
               var res;
               var val=$(this).parent().text();
               xhttpp.open("POST", "deleteentry.php", true);
               xhttpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
               xhttpp.send("del="+val);
               $(this).parent().parent().remove();
          }
        }
        });
      
        };
      
      http.open("POST", "search.php", true);
      http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http.send("val="+val);   

}

$(document).ready(function(){
    var i=1,titles=[],descrs=[];

    function tut_hide() {
      value4="tutorial";
      $('#mi').css({'opacity': '1','pointer-events': 'auto', 'background':'rgba(3, 3, 3, 0.726)'});
      $("*").find('div').not("#mi").not("#b").css('opacity', '0.1').addClass("disable")      ;
      $("#mi").slideDown("slow");
      value2="not";
     
  }
    function tut_show() {
      $("*").find('div').not("#mi").not("#b").css('opacity', '1').removeClass("disable")      ;
      $("#mi").slideUp("slow");
      value2="";
    }
    
  
    function hideall() {
      value4="";
      $("*").find('div').not("#mi").not("#b").css('opacity', '0.1').addClass("disable")      ;
    $("#mi").slideDown("slow");
     value3="not";
}
  function showall() {
    $("*").find('div').not("#mi").not("#b").css('opacity', '1').removeClass("disable")      ;
    $("#mi").slideUp("slow");
    value3="";
  }

  function menu_decider(){
    if(value1 =='menu')
    {
      if(value2=="")
      tut_hide();
      else
        tut_show();
    }
    else{
      if(value3=="")
        hideall();
      else
        showall();
    }
  }

  
  $("#menu").on("click", menu_decider);
  
  function hide() {
    $("*").find('div').not("#back").not("#popup").not("#lists").css('opacity', '0.1').addClass("disable")      ;
    $("#back").slideDown("slow"); 
    $("#popup").css({"display":"block"}).animate({width:'700px',
    height:'430px',top:'220px'},"slow"); 

    }
 
    function show() {
    $("*").find('div').not("#back").not("#popup").not("#lists").css('opacity', '1').removeClass("disable")      ;
    $("#lists").empty();
    $("#popup").slideUp();
    $("#back").slideUp("slow"); 
       }

  function create() {
    $('#wel').remove();
    $('#input').css({'display':'none'});
    $("#tutorial").css({'display':'none'});
   $("*").find('div').not("#back").not("#popup").not("#lists").css('opacity', '0.1').addClass("disable")      ;
   $("#back").slideDown("slow"); 
   $('#cross').css({"display":"none"});
   $("#popup").css({"display":"block"}).animate({width:'700px',
        height:'430px',top:'280px'},"slow"); 
   var p=$('<p id="text2"></p>').text('ENTER TASK DETAILS').css({'position':'absolute','top':'450px','left':'75px','color':'red','font-size':'30px'});
   var img=$("<img id='arr2' src='arrow2.png'></img>").css({'width':'100px','height':'100px','position':'absolute','top':'700px','left':'1500px'});  
   $('body').append(p); 
   $("#det").on('submit',function(event){
     if(event.result==true){
      var ifr= $('<iframe name="s" style="display:none;"></iframe>');
      $('body').append(ifr);      
      $('body').append(img);
       p.css({'display':'none'});
       $("#back").css({'opacity': '0.4','pointer-events': 'none'});
   
      }  
   });
   value=''; 
      }
         
  function plus_decider(){
    if(value =='tut')
    {
      $('#det').attr('target','s');
      create();
    }
    else{
      $('#det').removeAttr('target');
      hide();
    }
  }

  $("#plus").on("click", plus_decider);
  $("#cross").on("click", show);

 

  $("#add").on("click",function(){
   $('<p style="position:relative;left:-25px"><input type="text" placeholder="TITLE" name="tit[]" required  style="width:690px;height:30px;border:.25px dashed;margin-bottom:15px"/><textarea rows="6" cols="40" name="desc[]" required  placeholder="DESCRIPTION"  style="width:685px;height:90px;border:.25px dashed"></textarea> <a href="#" class="remove" style="color:red;text-decoration:none">Remove</a></p>').appendTo("#lists");
    i++;
   return false;
  });

  $("#lists").on('click', '.remove', function(){
       if( i >= 2 ) {
         $(this).parents('p').remove();
         i--;
 }
   return false; 
});

$("#det").on('submit',function(){
var d,d1,d2;
  d = document.forms["info_form"]["date"].value;
  d1 = new Date(d);
  var month = d1.getUTCMonth() + 1;
var day = d1.getUTCDate();
var year = d1.getUTCFullYear();
d1 = year + "/" + month + "/" + day;
d1 = new Date(d1);
var dateObj = new Date();
var month = dateObj.getUTCMonth() + 1;
var day = dateObj.getUTCDate();
var year = dateObj.getUTCFullYear();
d2 = year + "/" + month + "/" + day;
d2 = new Date(d2);
   if(d ==""){
     alert("date cannot be empty");
     return false;   
   } 
   if(d1<d2){
    alert("enter date of today or ahead of it");
    return false;     
   }
   else{
        alert("task inserted!");
        return true;
   }   
});
 $(".mii").on('click',function(){
  $("#results").removeClass("disable").css('opacity','1');
  $("*").find('div').not("#results").css('opacity', '0.1').addClass("disable")      ;
  $("#cr").css({'display':'block'});
  $("#results").css({"display":"block"}).animate({width:'1750px',
  height:'750px',top:'200px'},"slow");
  var value = $(this).text();
  var response,len1,len2,len3,tit,desc,div,div1,chk;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        response=JSON.parse(this.responseText);
        if(response.length>0){
          if(value4=="tutorial"){
            var p=$("<p class='para'></p>").text("DOUBLE CLICK A TASK TO EDIT IT!");
            p.css({'font-size':'30px','position':'absolute','top':'20px','left':'40%'});
            $('body').append(p);
           }
        
          len1=response[0].length;
          len2=response[1].length;
        var cnt1=0,cnt2=0,cnt3=0;
            while(cnt2<len2){
                if(response[1][cnt2].indexOf("~!#")>=0){
                  div=$("<div class='notes' name='notes[]'></div>");
                  div1=$("<div class='nt'></div>");                            
                  chk=$('<input type="checkbox" class="check" name="check[]"/>' );
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  chk.appendTo(div);
                  cnt3=0;
                  tit=response[1][cnt2].split("~!#");
                  desc=response[4][cnt2].split("~!#");
                  len3=tit.length;
                  while(cnt3<len3){
                    $("<span class='in'></span>").text("TITLE:-").appendTo(div);
                    $('<p class="in"></p><br>').text(tit[cnt3]).appendTo(div);
                    $("<span class='in'></span>").text("DESCRIPTION:-").appendTo(div);                  
                    $('<p class="in"></p><br>').text(desc[cnt3]).appendTo(div);
                     cnt3++;           
                  }
                  $("<span class='in'></span>").text("DATE:-").appendTo(div);                    
                  $('<p class="in"></p><br>').text(response[2][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("PRIORITY:-").appendTo(div);                    
                  $('<p class="in"></p><br>').text(response[3][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("created-on:-").appendTo(div);                                      
                  $('<p class="in"></p><br>').text(response[0][cnt2]).appendTo(div);
                }
                else{
                  div=$("<div class='notes' name='notes[]'></div>");
                  div1=$("<div class='nt'></div>");                              
                  chk=$('<input type="checkbox" class="check" name="check[]"/>' );
                  chk.appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<br>").appendTo(div);
                  $("<span class='in'></span>").text("TITLE:-").appendTo(div);                   
                  $('<p class="in"></p><br>').text(response[1][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("DESCRIPTION:-").appendTo(div);                 
                  $('<p class="in"></p><br>').text(response[4][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("DATE:-").appendTo(div);                   
                  $('<p class="in"></p><br>').text(response[2][cnt2]).appendTo(div);
                  $("<span class='in'></span>").text("PRIORITY:-").appendTo(div);                    
                  $('<p class="in"></p><br>').text(response[3][cnt2]).appendTo(div); 
                  $("<span class='in'></span>").text("created-on:-").appendTo(div);             
                  $('<p class="in"></p><br>').text(response[0][cnt2]).appendTo(div);  
                }
                 cnt2++;        
                 div1.append(div);
               $("#results").append(div1);
        }
      }
      else{
        if(value4=="tutorial"){
          var p=$("<p class='para'></p>").text("CHOOSE RIGHT CATEGORY!");
          p.css({'font-size':'30px','position':'absolute','top':'20px','left':'40%'});
          $('body').append(p);
         }
        
        div=$("<div></div>").text("empty").css({"font-size":"100px","text-align":"center"});
        $("#results").append(div);
                   
      }
     }
     $(".check").change(function(){
      if(this.checked){
        if (confirm("REMOVE THIS TASK ")) {
           var xhttpp = new XMLHttpRequest();
           var res;
           var val=$(this).parent().text();
           xhttpp.open("POST", "deleteentry.php", true);
           xhttpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhttpp.send("del="+val);
           $(this).parent().parent().remove();
      }
    }
    });
    $(".notes").on("dblclick",function(){
         $("#staticnotes").removeClass("disable").css('opacity','1');  
         $("#bignotes").removeClass("disable").css('opacity','1');
         $("*").find('div').not("#bignotes").css('opacity', '0.1').addClass("disable")      ;       
         $("#staticnotes").slideDown("slow"); 
         $("#bignotes").css({"display":"block"});
         $("#cro").css({'display':'block'});
      
      
         if(value4=="tutorial"){
          $('body').removeAttr('background');
          $('.para').remove(); 
          $("#cro").css({'display':'none'});
          $('#div_tut').remove();        
          var p=$("<p class='par'></p>").text("EDIT TASK AND SAVE IT!");
          p.css({'font-size':'30px','position':'absolute','top':'20px','left':'40%'});
          $('body').append(p);
          $("#bignotes").css('top','170px');
               
        }
           
         var txt = $(this).html();
        var xht = new XMLHttpRequest();
        xht.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200){ 
                  parsed = JSON.parse(this.responseText);
                  var len=0;cnt=0;
                  var frm=$("<form name='notes_form' id='fr'>");
                  var div=$('<div>/<div>');
                  if(typeof parsed[0] == 'object')
                        len=parsed[0].length;
                    if(len>1){
                    while(cnt<len){
                       if(cnt==0){
                       $("<span></span>").text("TITLE:-").appendTo(frm);
                       $("<br>").appendTo(frm);
                       $("<input type='text' name='ti[]' required   style='width:690px;height:30px;border:.25px dashed;margin-bottom:15px'></input>").val(parsed[0][cnt]).appendTo(frm);
                       $("<br>").appendTo(frm); 
                       $("<span></span>").text("DESCRIPTION:-").appendTo(frm);
                       $("<br>").appendTo(frm);                  
                       $("<textarea rows='6' cols='40' name='de[]' required  style='width:685px;height:90px;border:.25px dashed'></textarea>").val(parsed[1][cnt]).appendTo(frm);
                       $("<br>").appendTo(frm);

                       }
                       else{
                      var q=$("<div class='a'></div>");
                      $("<span></span>").text("TITLE:-").appendTo(q);
                      $("<br>").appendTo(q);
                      $('<input type="text" name="ti[]" required   style="width:690px;height:30px;border:.25px dashed;margin-bottom:15px"></input>').val(parsed[0][cnt]).appendTo(q);
                      $("<br>").appendTo(q);
                      $("<span></span>").text("DESCRIPTION:-").appendTo(q);   
                      $("<br>").appendTo(q);                 
                      $('<textarea rows="6" cols="40" required name="de[]"  style="width:685px;height:90px;border:.25px dashed" </textarea>' ).val(parsed[1][cnt]).appendTo(q);
                      $("<br>").appendTo(q);
                      $('<a href="#" class="rem">Remove</a>').appendTo(q);                    
                      $("<br>").appendTo(q);
                      q.appendTo(frm);
                                     }
                       cnt++;
                    }  
                  }  
                  else{
                      $("<span></span>").text("TITLE:-").appendTo(frm);
                      $("<br>").appendTo(frm);
                      $("<input type='text' name='ti[]' required   style='width:690px;height:30px;border:.25px dashed;margin-bottom:15px'></input>").val(parsed[0]).appendTo(frm);
                      $("<br>").appendTo(frm);
                      $("<span></span>").text("DESCRIPTION:-").appendTo(frm);   
                      $("<br>").appendTo(frm);                                    
                      $("<textarea rows='6' cols='40' name='de[]' required  style='width:685px;height:90px;border:.25px dashed'></textarea>").val(parsed[1]).appendTo(frm);
                      $("<br>").appendTo(frm);
                    }
                    div.appendTo(frm);
                    $("<a href='#'class='atd'  style='color:green;text-decoration:none'>ADD MORE TITLE</a>").appendTo(frm); 
                    $("<br>").appendTo(frm);


                    $("#bignotes").on('click','.atd',function(){
                      var pd=$('<p id="pd"></p>');              
                     $("<span></span>").text("TITLE:-").appendTo(pd);
                     $("<input type='text' name='ti[]' required style='width:690px;height:30px;border:.25px dashed;margin-bottom:15px'></input>").appendTo(pd);
                     $("<br>").appendTo(pd);
                     $("<span></span>").text("DESCRIPTION:-").appendTo(pd);
                     $("<br>").appendTo(pd);                                       
                     $("<textarea rows='6' cols='40' name='de[]' required  style='width:685px;height:90px;border:.25px dashed'></textarea>").appendTo(pd);
                     $('<a href="#" class="rem"  style="color:red;text-decoration:none">Remove</a>').appendTo(pd);         
                     $("<br>").appendTo(pd);                               
                     pd.appendTo(div); 
                    });
                    $("#bignotes").on('click','.rem',function(){
                           $(this).parent().remove();
                             
                    });
                    $("<span style='position:relative;top:25px'></span>").text("DATE:-").appendTo(frm);                                                
                    $("<input type='date' name='dat' style='position:relative;top:25px'></input>").val(parsed[2]).appendTo(frm);
                    $("<br>").appendTo(frm);
                    var sel=$("<select id='sele' name='se' style='position:relative;left:470px'><select>");
                    $("<option></option>").html("NORMAL").appendTo(sel);
                    $("<option></option>").html("IMPORTANT").appendTo(sel);
                    $("<option></option>").html("VERY-IMPORTANT").appendTo(sel);
                    $(sel).val(parsed[3]);
                    $("<span style='position:relative;left:450px;font-size:20px'></span>").text("PRIORITY:-").appendTo(frm);                   
                    $(frm).append(sel);
                    $("<br>").appendTo(frm);
                    $("<p name='ts'></p>").text(parsed[4]).appendTo(frm);
                    $("<button id='clk'></button>").text("SAVE").appendTo(frm);
                    $("#bignotes").append(frm);
                    $("#bignotes").on('click','#clk',function(){
                      var c=0,a1=[],a2=[],a3,a4,a5,a=[],b1=true,b2=true;
                        $('input[name="ti[]"]').each(function(){
                           if($(this).val()==""){
                             b1=false;
                           }
                           else{ 
                           a1[c]=$(this).val();
                           }
                            c++;       
                      });
                      if(b1==false){
                        alert("EVERY TITLE IS REQUIRED");                          
                      }
                      k =document.getElementsByTagName("textarea")
                     for (var i = 0; i < k.length; i++){
                        if(k[i].value==""){
                          alert("EVERY DESCRIPTION IS REQUIRED");
                          b2=false;
                          break;
                      }
                      else 
                        a2[i]=k[i].value;   
                     }
                      a3=$("input[name='dat']").val();
                      var d1,d2,bool;
                      d1 = new Date(a3);
                      var dateObj = new Date();
                      var month = dateObj.getUTCMonth() + 1;
                      var day = dateObj.getUTCDate();
                      var year = dateObj.getUTCFullYear();
                      d2 = year + "/" + month + "/" + day;
                      d2 = new Date(d2);
                if(a3 ==""){
                  alert("date cannot be empty");
                  bool= false;   
                    } 
                if(d1<d2){
                  alert("enter date of today or ahead of it");
                  bool= false;     
                  }
                  else
                  bool= true;   

                      a4=$(sel).val();
                      a5=parsed[4];
                      a=[a1,a2,a3,a4,a5];
                      if(bool==true&&b1==true&&b2==true){
                      a=JSON.stringify(a);
                      var x = new XMLHttpRequest();
                      x.open("POST", "update.php", true);
                      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      x.send("updt="+a);
                      alert("TASK UPDATED!"); 
                      if(value4=="tutorial"){
                        $('.par').remove();
                        alert('END OF TUTORIAL!');
                         
                      }
                      

                      }   
                      else{
                        return false;
                      }
                     });
                      
                     
                    }
           };
            
 
        xht.open("POST", "htmlparse.php", true);
        xht.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xht.send("html="+txt);
       
    });
    };

  xhttp.open("POST", "senddata.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("val="+value);
  
});

function sh() {
  if(value4=="tutorial"){
   $('.para').remove();
  }
  
  $("*").find('div').not("#results").css('opacity', '1').removeClass("disable")      ;
  $("#results div").remove();
  $("#results").animate({width:'0px',height:'0px',top:'300px'},"slow");  
  $("#cr").css({'display':'none'});
}
$("#cr").on("click", sh);

function sho() {
  $("*").find('div').not("#bignotes").not('#b').not('#mi').not('#input').css('opacity', '1').removeClass("disable")      ;
  $("#bignotes form").remove(); 
  $("#staticnotes").slideUp("slow");    
  $("#cro").css({'display':'none'});
}
$("#cro").on("click", sho);

$('#tutorial').on('click',function(){
  value="tut";
  $('#tutorial').css('display','none');
  var exit_button=$("<button id='exit_button'></button>").text("EXIT TUTORIAL");
  exit_button.css({'width':'100px','height':'50px','position':'absolute','top':'20px','left':'20px','color':'red','font-weight':'bold'});
  $('body').append(exit_button);
  var p1=$("<p id='wel'></p>").text("WELCOME TO TODO LIST TUTORIAL!");
  p1.css({'font-weight':'bold','font-size':'40px','position':'absolute','top':'20px','left':'30%','color':'red'});
  $('body').append(p1);
  $('#nav').css('background','');
  $("*").find('div').not("#input").not("#back").not("#popup").not("#lists").css('opacity', '0.1').addClass("disable")      ;
  $("*").find('div').not("#input").not("#back").not("#popup").not("#lists").css({'background':'white'})      ;
  $('*').find('section').not("#nav").css('opacity', '0.1').addClass("disable")      ;
  $('#header').css({'background':'white','box-shadow':'none'})      ;
  $("#input").css({'width':'400px','height':'400px','background-color':'lavender','border-radius':'50%','right':'0px','top':'-60px'}); 
  $('#plus').css({'position':'relative','top':'144px','left':'75px'});
  $('#c').css({'position':'relative','top':'150px','left':'75px','color':'red'});
  var img=$("<img id='arr' src='arrow1.png'></img>").css({'width':'100px','height':'100px','position':'absolute','top':'190px','left':'100px'});
  var p =$('<p id="text"></p>').text("click button").css({'position':'absolute','top':'260px','left':'100px','color':'black'});
  $('#input').append(img);
  $('#input').append(p);
});

$('body').on('click','#arr2',function(){
  value1='menu';
  $('#det').find("input[type=text], textarea,input[type=date]").val("");        
  $('#selectlist').prop('selectedIndex',0);
  $('#b').css('opacity', '1').removeClass("disable") ;   
  $("#back").css({'display':'none'});    
  var div_tut=$('<div id="div_tut"></div>').css({'width':'250px','height':'250px','position':'absolute','left':'450px','top':'0px'});
  var img=$("<img id='arr3' src='arrow3.png'></img>").css({'width':'100px','height':'100px'});
  var p =$('<p></p>').text("CLICK BUTTON").css({'color':'red','font-size':'20px'});
  div_tut.append(img) 
  div_tut.append(p);
   $('body').append(div_tut); 
   $('#arr2').remove();
   
});

$('body').on('click','#exit_button',function(){
   
  location.reload(true);
 
});

});
