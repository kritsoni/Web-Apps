var notifications;
window.onload = function() {
 
 no();
};
function notify(notification){
  notifications=notification;
}
function no(){
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.ajax({             
url: "/nonoti",
method:'get',
success: function(response){ 
  if(response>0)
  $('#no_noti').text(response);  
}
   
});

   }
  
$(document).ready(function(){
  
$('body').css({'background':'rgba(232,226,250,.8)'}); 
  var event1="" ;
   var event2="";
   var event3="";   
   var event4="";
   var event5="";
   var event6="";
   var event7="";
   var event8="";
   var t="";
   var d="";
   var bgcol=[];
   var txtcol=[];
   var frame=[];

   var active1 = false;
  var active2 = false;
  var active3 = false;
  var active4 = false;

  $('.radial-menu').on('mousedown touchstart', function() {
  
  if (!active1) $(this).find('.menu-item1').css({
    'background-color': 'gray', 
    'transform': 
    'translate(0px,225px)'
  });
  else $(this).find('.menu-item1').css({
    'background-color': 'dimGray', 
    'transform': 'none'
  }); 
  
  if (!active2) $(this).find('.menu-item2').css({
    'background-color': 'gray', 
    'transform': 'translate(60px,205px)'
  });
  else $(this).find('.menu-item2').css({
    'background-color': 'darkGray', 
    'transform': 'none'
  });

  if (!active3) $(this).find('.menu-item3').css({
    'background-color': 'gray', 
    'transform': 'translate(105px,160px)'
  });
  else $(this).find('.menu-item3').css({
    'background-color': 'silver', 
    'transform': 'none'
  });

  if (!active4) $(this).find('.menu-item4').css({
    'background-color': 'gray', 
    'transform': 'translate(125px,100px)'
  });
  else $(this).find('.menu-item4').css({
    'background-color': 'silver', 
    'transform': 'none'
  });

  active1 = !active1;
  active2 = !active2;
  active3 = !active3;
  active4 = !active4;
    
  });

   
    $("#desc").hide();
  
    $("#note").on('click',function(event){
        $("#desc").show();
        $('#note').attr('placeholder','TITLE');
        event1="ready";
        event.stopPropagation();
        $('*').find('div').not('.nav').not('.input').css({'pointer-events': 'none'});
        $('#note').css({'pointer-events': 'auto'});
        $('#desc').css({'pointer-events': 'auto'});
    });
    $('html').click(function(evt){
        if(event1 == 'ready'){
       
            if(evt.target.id == "note" || evt.target.id == "desc" )
            return;      
        
         if(($('#note').val() != "" || $('#desc').val() != "") && ($('#note').val().replace(/\s/g, '').length != 0 || $('#desc').val().replace(/\s/g, '').length != 0)){
             $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
               });
             $.ajax({             
            url: "/task",
            method:'post',
            data:{
              title:$('#note').val(),
              description:$('#desc').val()
            },
            success: function(response){ 
             location.reload(); 
          }
                  
         });
     }
         $("#desc").hide();
         $('#note').attr('placeholder','CREATE A NOTE').val(''); 
         $('#desc').val(''); 
          event1="";
          $('*').find('div').not('.nav').css({'pointer-events': 'auto'}); 
    }
  });

       $('.notes').on('dblclick',function(event){
        if(!window.location.href.includes('trash'))
        $('.input,.data,h1').css({'display': 'none'}); 
          var url;
           $('#bdy').empty();
           if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
             var type=$(this).find('#type').val();
             if(type == 'task'){
               url='/getlabels';
               var typ= $('<input type="hidden" id="type"  value="task">');
               $('#bdy').append(typ);
             } 
             else if(type == 'archive'){
              url='/archivegetlabels';
              var typ= $('<input type="hidden" id="type"  value="archive">');
              $('#bdy').append(typ);
        } 
      }
           else{
             url =window.location.href+"getlabels";
           }
           var frm= $("<form></form>");
           var div1=$("<div class='form-group mb-0 div1'></div>");
           var div2=$("<div class='form-group mt-0 div2'></div>");
           var ip1=$('<input type="text" class="form-control round" id="note" name="title" placeholder="TITLE" autocomplete="off" >');
           var ip2=$('<textarea class="form-control rnd" rows="5" id="desc" name="description" placeholder="DESCRIPTION"></textarea>');
           var id = $(this).find('#id').val();
           var tit = $(this).find(".title").text();
           var des =$(this).find(".description").text(); 
           var ip3=$(' <input type="hidden" id="id">').val(id);
           var div=$('<div class="div3"></div>').css({'max-width':'450px','max-height':'150px','overflow':'auto'});
           t=tit;
           d=des;


                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                  $.ajax({             
                url:'/getreminder',
                method:'post',
                data:{
                  data:id
                },
                success: function(response){ 
                  var noti = response;
                  if(noti!=""){
                    var d=$("<div></div>");
                    var span=$('<span class="removenoti"></span>').text("X").css({'padding-left':'5px','color':'red','cursor':'pointer'});
                    var p=$('<p class="notiresponse"></p>').text(noti).css({'display':'inline-block','border':'solid','margin-right':'5px','padding':'5px','color':'white','background':'grey','border-radius':'10px'}).append(span);
                    d.append('<i class="fas fa-clock "></i>').append(p);
                  $('#bdy').append(d);
              }
            }                
              });

              $('body').on('click','.removenoti',function(event){
                  url ="/removenoti";
                 var id=$(this).parent().parent().parent().find('#id').val();
                $(this).parent().parent().remove();  
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
              $.ajax({             
                  url:url,
                  method:'post',
                  data:{
                    id:id,
                  },
                  success: function(){ 
                    if(window.location.href.includes('notific')){
                      window.location.reload();
                    }
             
                  }        
                });
               
                 event.stopImmediatePropagation();
      
              });
                    
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            $.ajax({             
          url:url,
          method:'post',
          data:{
            id:id
          },
          success: function(response){ 
            var labs = JSON.parse(response);
            var urll='/viewlabeltasks/';
            if(labs[0]!=false){  
            $.each(labs, function (index, value) {
              var span=$('<span class="removelbl"></span>').text("X").css({'padding-left':'5px','color':'red','cursor':'pointer'});
              var a =$("<a></a>").attr('href',urll+value).text(value).css({'color':'white'});
              var p=$('<p class="labls"></p>').append(a).append(span).css({'display':'inline-block','border':'solid','margin-right':'5px','padding':'5px','background':'grey','border-radius':'10px'});
              div.append(p);
           
            }); 
            $('#bdy').append(div);
          }
      }                
        });
        
        
      
        $('body').on('click','.removelbl',function(event){
          var url;
          if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
            var type=$('#bdy').find('#type').val();
            if(type == 'task'){
              url='/removelabel';
             
            }
            if(type == 'archive'){
             url='/archiveremovelabel';
           
            }
            }
          else{
            url =window.location.href+"removelabel";
          }
          var id=$(this).parent().parent().parent().find('#id').val();
          var label=$(this).parent().text().substring(0,($(this).parent().text().length)-1);
          $(this).parent().remove();  
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({             
            url:url,
            method:'post',
            data:{
              id:id,
              label:label
            }
          });
         
          event.stopImmediatePropagation();

        });
           if(tit !="" && des !=""){
            ip1.val(tit);
            ip2.val(des);
            div1.append(ip1);
            div2.append(ip2);
            frm.append(div1).append(div2).append(ip3);
            $('#bdy').append(frm);
        }

         else{
             if(tit!=""){
                ip1.val(tit);
                div1.append(ip1);
                div2.append(ip2);
                frm.append(div1).append(div2).append(ip3);
                $('#bdy').append(frm);
             }

             else if(des!=""){
                ip2.val(des);
                div1.append(ip1);
                div2.append(ip2);
                frm.append(div1).append(div2).append(ip3);
                $('#bdy').append(frm);
             }
         }
           
        $('.modal').css({'display':'block'}); 
        event2="ready";
        event.stopPropagation();
        $('html').click(function(evt){   
            if(event2=='ready'){
                if(evt.target.id == "bdy"  )
                  return;      
                if($(evt.target).closest('#bdy').length)
                 return;
                 var url;
                  if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                    var type=$('#bdy').find('#type').val();
                    
                    if(type == 'task')
                      url='/12';
                    if(type == 'archive')
                      url='/archive12';
                  }
                  else{
                    url = window.location.href+"12";
                  }
                   var id = $('#bdy').find('#id').val();
                   var tit = $('#bdy').find('#note').val();
                   var desc= $('#bdy').find('#desc').val()
                if((tit != "" || desc != "")&&(tit !=t || desc != d)){
                    $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                    $.ajax({             
                   url:url,
                   method:'patch',
                   data:{
                     id:id,
                     title:tit,
                     description:desc
                   },
                   success: function(response){ 
                     location.reload();
                 }
                         
                });
            }    

          if(window.location.href.includes('viewlabeltasks')){
            window.location.reload();
          }
            $('.modal').css({'display':'none'});
            event2="";
            if(!window.location.href.includes('trash'))         
            $('.input,.data,h1').css({'display': 'block'}); 
         
        }

           });    

        });

       $('.trash').on('click',function(){
          var url;
          if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
            var type=$(this).parents('.note').find('#type').val();
            if(type == 'task')
              url='/123';
            if(type == 'archive')
             url='/archive123';
          }
          else{
            url =window.location.href+"123";
          }
            
        var id = $(this).parents('.note').find('#id').val();
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
         $.ajax({             
          url:url,
          method:'delete',
          data:{
            id:id
          },
          success: function(response){ 
            location.reload();
            
        }
                
       });

         
       });
 
       $('.bgcolor').click(function(event){
        
        if($('#picker').length || ($('#all_labels').length) || $('#reminders').length){
         return
        }  
         var note = $(this).parents('.note');
         var notes = $(this).parents('.note').find('.notes');
         var id= $(this).parents('.note').find('#id').val();
         var type=$(this).parents('.note').find('#type').val();
         var div = $('<aside id="picker"></aside>').css({'position':'absolute','background':'#EEE2FB','width':'400px','height':'300px'});
         bgcol[0]=id;
         note.append(div);

           $('#picker').farbtastic(function(color){
           notes.css({'background-color':color});
           bgcol[1]=color;
           bgcol[2]=type; 
       });
         event3="ready";
           event.stopPropagation();
      });


       $('html').click(function(evt){
         if(event3 == 'ready'){
           if(evt.target.id == 'picker')
            return;
          if ($('#picker:hover').length != 0) 
              return;   
              var url;
              if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                var type=bgcol[2];
                if(type == 'task')
                  url='/123';
                if(type == 'archive')
                 url='/archive123';
              }
              else{
                url = window.location.href+"123";
              }
                   
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            $.ajax({             
           url:url,
           method:'patch',
           data:{
             id:bgcol[0],
             color:bgcol[1]
           }
                 
        });
       
        $('#picker').remove();
             event3=""; 
   
         }
         });   

         $('.txtcolor').click(function(event){
          if($('#picker').length || ($('#all_labels').length) || $('#reminders').length){
            return
           }  
              var note = $(this).parents('.note');
           var tit = $(this).parents('.note').find('.title');
           var des = $(this).parents('.note').find('.description');
           var div = $('<aside id="picker"></aside>').css({'position':'absolute','background':'#EEE2FB','width':'400px','height':'300px'});
           var id= $(this).parents('.note').find('#id').val();
           var type=$(this).parents('.note').find('#type').val();
           txtcol[0]=id;       
           note.append(div);
           $('#picker').farbtastic(function(color){
            tit.css({'color':color});
            des.css({'color':color});
            txtcol[1] = color;
            txtcol[2] = type;
         });
           
           event4="ready";
             event.stopPropagation();
        });
  
  
         $('html').click(function(evt){
           if(event4 == 'ready'){
             if(evt.target.id == 'picker')
              return;
            if ($('#picker:hover').length != 0) 
                return;    
                var url;
                if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                  var type=txtcol[2];
                  if(type == 'task')
                    url='/1234';
                  if(type == 'archive')
                   url='/archive1234';
                }
                else{
                  url =  window.location.href+"1234";
                }
              
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
              $.ajax({             
             url: url,
             method:'patch',
             data:{
               id:txtcol[0],
               color:txtcol[1]
             }
                   
          });

               $('#picker').remove();
               event4=""; 
     
           }
           });  

           $('.frame').click(function(event){
            
            if($('#picker').length || ($('#all_labels').length) || $('#reminders').length){
              return
             }  
                   var note = $(this).parents('.note');           
              var notes = $(this).parents('.note').find('.notes');
              var div = $('<aside id="picker"></aside>').css({'position':'absolute','background':'#EEE2FB','width':'400px','height':'300px'});
              var id= $(this).parents('.note').find('#id').val();
              var type= $(this).parents('.note').find('#type').val();
              var opt = $(this).parent().parent();
              frame[0]=id;       
              note.append(div);
              $('#picker').farbtastic(function(color){
               notes.css({'border':'5px solid'+color});
               opt.css({'border':'5px solid'+color,'border-top':'none'});
               frame[1] = "5px solid"+" "+color;
               frame[2] = type;
            });
              
              event5="ready";
                event.stopPropagation();
          
           
          });

          $('html').click(function(evt){
            if(event5 == 'ready'){
              if(evt.target.id == 'picker')
               return;
             if ($('#picker:hover').length != 0) 
                 return;    
                 var url;
                 if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                   var type=frame[2];
                   if(type == 'task')
                     url='/12345';
                   if(type == 'archive')
                    url='/archive12345';
                 }
                 else{
                   url =  window.location.href+"12345";
                 }
               
                 $.ajaxSetup({
                   headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                 });
               $.ajax({             
              url: url,
              method:'patch',
              data:{
                id:frame[0],
                color:frame[1]
              }
                    
           });
 
                $('#picker').remove();
                event5=""; 
      
            }
            });  

            $('.trash2').click(function(evt){
             
                var id = $(this).parents('.note').find('#id').val();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({             
                  url: "/trash",
                  method:'delete',
                  data:{
                    id:id
                  },
                  success: function(response){ 
                    location.reload();
                    
                }
                        
              });
              
            });  
            
            $('.restore').click(function(){
                  var id = $(this).parents('.note').find('#id').val();

                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                    $.ajax({             
                  url: "/trash",
                  method:'patch',
                  data:{
                    id:id
                   },
                   success: function(response){ 
                     location.reload();
                   }
                        
                });

            });

            $('.arch').click(function(evt){
             
              var id = $(this).parents('.note').find('#id').val();

              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
                $.ajax({             
              url: "/archive",
              method:'delete',
              data:{
                id:id
               },
               success: function(response){ 
                 location.reload();
               }
                    
            });


            })

            $('.unarch').click(function(){
 
              var id = $(this).parents('.note').find('#id').val();

              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
                $.ajax({             
              url: "/unarchive",
              method:'delete',
              data:{
                id:id
               },
               success: function(response){ 
                 location.reload();
               }
                    
            });
             
            })

            $('#label').click(function(){
              if($('#notifications').css('display') == 'block'){
                $('#notifications').css('display','none');
              }
              
              $('#labels').slideToggle('slow');
              if($('#edit').css("display") == "inline"){
                setInterval(function(){ location.reload(); }, 600);  
              }
            });

            $('#closeedit').click(function(){
              $('#editval').val("");
              $('#edit').css({'display':'none'});
              $('.add').css({'display':'inline'});
              $('#labels').slideUp('slow');
              setInterval(function(){ location.reload(); }, 600);
            });

            $('.tag').click(function(){
       
              if($('#picker').length || ($('#all_labels').length) || $('#reminders').length){
                return
               }  
                       var note = $(this).parents('.note');
                var notes = $(this).parents('.note').find('.notes');
                var id= $(this).parents('.note').find('#id').val();
                var type=$(this).parents('.note').find('#type').val();
                var div = $('<aside id="all_labels"></aside>');
                var head=$('<h4></h4>').text('ADD LABELS');
                div.append(head);
                div.css({'max-height':'300px','width':'180px','overflow':'auto','border':'solid','display':'none'});
                var url;
                 if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                  
                   if(type == 'task')
                     url='/showlabels';
                   if(type == 'archive')
                    url='/archiveshowlabels';
                 }
                 else{
                   url =  window.location.href +"showlabels";
                 }
               
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({             
                  url: url,
                  method:'post',
                  data:{id:id},
                  success: function(response){
                    var labs=JSON.parse(response);
                    $.each(labs, function (index, value) {
                       var chk=$('<input type="checkbox" name="tick">').val(value);
                       var p=$('<p></p>').text(value).css('display','inline');
                       var br=$('<br>');
                       div.append(chk).append(p).append(br);   
                     });
                    var btn=$('<button id="add_label">ADD</button>');
                    div.append(btn);
                    note.append(div);
                    div.css({'position':'absolute','display':'block','background':'white'});
                    var all=[];
                    $('#add_label').on('click',function(){
                      var count=0;
                      $('input[name="tick"]:checked').each(function() {
                           all[count]=$(this).val();
                           count++;
                     });
                
                     all=JSON.stringify(all);
                     var url;
                     if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                       if(type == 'task')
                         url='/addlabels';
                       if(type == 'archive')
                        url='/archiveaddlabels';
                     }
                     else{
                       url = window.location.href+"addlabels";
                     }
                   
                     $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });
                  $.ajax({   
                              
                 url: url,
                 method:'patch',
                 dataType: "json",
                 data:{
                   id:id,
                   labels:all
                 }     
              });
              $('#all_labels').remove();
                    
                    });
                  
            }
                    
            });
                
              
                  event6="ready";
                  event.stopPropagation();
             
            });
      
      
            $('html').click(function(evt){
              if(event6 == 'ready'){
                if(evt.target.id == 'all_labels')
                 return;
               if ($('#all_labels:hover').length != 0) 
                   return;   
                
               $('#all_labels').remove();
                 event6=""; 
         
              }            
             });
                        
              $('.remind').on('click',function(){
            
                if($('#picker').length || ($('#all_labels').length) || $('#reminders').length){
                  return
                 }  
                         
                var note = $(this).parents('.note');
                var id= $(this).parents('.note').find('#id').val();
                var div = $('<div id="reminders"></div>').css({'border':'solid','display':'none'}).css({'width':'180px'});
                var head= $('<h5></h5>').text('ADD REMINDER'); 
                var sp1= $('<span></span>').text('DATE:-');
                var sp2= $('<span></span>').text('TIME:-');
                var ipdate =$('<input type="text" id="datepicker" readonly="readonly" />').css({'width':'90px'});
                var iptime =$('<input type="text" id="timepicker" readonly="readonly" />').css({'width':'90px'});
                var br1 =$('<br>');
                var br2 =$('<br>');
                var br3 =$('<br>');
                var btn=$('<button id="add_reminder">ADD</button>');
                div.append(head).append(sp1).append(ipdate).append(br1).append(br2).append(sp2).append(iptime).append(br3).append(btn);
                note.append(div);
                div.css({'position':'absolute','display':'block','background':'white'});
                $("#datepicker").datetimepicker({
                  minDate:new Date(),
                  altField:'#timepicker'
                 });            
               
                 $('#add_reminder').on('click',function(){
                  var type=$(this).parents('.note').find('#type').val(); 
                  var date=$('#datepicker').val();
                 var time=$('#timepicker').val();
                 var url;
                 if(window.location.href.includes('viewlabeltasks')||window.location.href.includes('notific') || window.location.href.includes('viewnotitasks') || window.location.href.includes('viewnotiarchivetasks')|| window.location.href.includes('search')){
                   if(type == 'task')
                     url='/addreminder';
                   if(type == 'archive')
                    url='/archiveaddreminder';
                 }
                 else{
                   url = window.location.href+"addreminder";
                 }
               
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({   
                                
                  url: url,
                  method:'post',
                  data:{
                    id:id,
                    date:date,
                    time:time
                  },success(response){
                    console.log(response);
                  }     
                });

                $('#reminders').remove();
              });
                 event7="ready";
                 event.stopPropagation();
           

              });
          
             
            
              $('html').click(function(evt){
                if(event7 == 'ready'){
                var cal = $('body').find('.ui-datepicker-header').parent();
                cal.click(function(event){
                  event8="";
                  event.stopImmediatePropagation();
                });
                event8="ready";
            }
          });
          

          $('html').click(function(evt){
            if(event8 == 'ready'){
              if(evt.target.id == 'reminders')
               return;
             if ($('#reminders:hover').length != 0) 
                 return;   
              
             $('#reminders').remove();
               event8=""; 
       
            }            
           });

           $('#notification').click(function(){
            if($('#labels').css('display') == 'block'){
              $('#labels').css('display','none');
            }
             
            $('#notifications').slideToggle('slow');
            if($('#no_noti').text()!=""){
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({             
              url: "/makeread",
              method:'post',
              dataType: "json",
              data:{
                noti:notifications,
              },
              success: function(response){ 
               console.log(response); 
              }
                 
              });
              
            }
            $('#no_noti').text('');
          });
  
        $('.pin').click(function(){
            var id= $(this).parents('.note').find('#id').val();
            var type=$(this).parents('.note').find('#type').val(); 
            var url;
           if(type == 'task')
             url='/pinunpin';
           if(type == 'archive')
            url='/pin';
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({                        
          url: url,
          method:'post',
          data:{
            id:id,
          },success(){
            location.reload();
          }     
        });

        })
});
