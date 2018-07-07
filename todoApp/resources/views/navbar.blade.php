<div class="container" class='nav'>

<nav class="navbar navbar-expand bg-dark navbar-dark fixed-top" style="position:fixed;left:100px;height:100px">
  <ul class="navbar-nav">
    <li class="nav-item">
      <div class="radial-menu">
  <a class="menu-item1" href='/'><i class="fa fa-home fa-2x"></i></a>
  <a class="menu-item2" href="/notific"> <i class="fas fa-clock fa-2x"></i></a>
  <a class="menu-item3" href='/archive'><i class="fas fa-archive fa-2x"></i></a>
  <a class="menu-item4" href='/trash'><i class="fas fa-trash-alt fa-2x"></i></a>
  <div class="mask"><i class="fas fa-bars fa-3x"></i></div>
</div>
    </li>
    <li class="nav-item" style="padding-left:30px;padding-top:25px;">
     <p style="font-size:40px;color:white">TODOAPP</p>
    </li>
  
    <li class="nav-item" style="padding-left:150px;padding-top:33px;">
    <form method="post" action="/search">
    <div class="container">
    <div class="form-group">
    {{ csrf_field() }}
    <input type="text" class="form-control" autocomplete="off" name="search" placeholder="Search" >
    <button type="submit" style="position:relative;left:105%;top:-38px"><img src='/css/search.jpeg'  style="width:30px;height:30px;"></button>
    </form>
    </div>
  </div>
  </li>
  
  <li class="nav-item" style="padding-top:30px;">
      <img src='/css/alarm.png' style="position:absolute;right:140px;" id="notification"> 
    <span style="color:red;position:absolute;right:120px;" id="no_noti"></span> </li>
  

    <li class="nav-item" style="padding-top:30px;">
      <img src='/css/price-tag.png' style="position:absolute;right:30px;" id="label"> 
     </li>
  
  </ul>
</nav>

</div>
              
<script>

var app = angular.module("lab", [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }); 
app.controller("myCtrl", function($scope, $http) {
  var lab ="";
  $scope.label="viewlabeltasks/";
     $scope.labels=[];
      $http.get("/label")
      .then(function(response) {  
          for(var cnt=0;cnt<response.data.length;cnt++){

         $scope.labels[cnt]=response.data[cnt].label;
        }
        
          });  
    
    
     $scope.addItem = function () {
        $scope.errortext = "";
        if (!$scope.addMe) {return;}
        if ($scope.labels.indexOf($scope.addMe) == -1) {
            $scope.labels.push($scope.addMe);
            $http({
         method: 'POST',
         url: '/label',
         data: "label=" + $scope.addMe,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
     });
            $scope.addMe="";
        } else {
            $scope.errortext = "label exists";
         }
        }
      
    $scope.removeItem = function (x,label) {
        $scope.errortext = "";    
            $http({
         method: 'DELETE',
         url: '/label',
         data: "label=" + label,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
     }).then(function(){
             $http({
         method: 'DELETE',
         url: '/removelabel',
         data: "label=" + label,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
     });
     });

        $scope.labels.splice(x, 1);
    }

    $scope.editItem = function (x,label) {
          
        $('.add').css({ "display" : "none"});        
        $('#edit').css({ "display" : "inline"});
        var myEl = document.getElementById('edit');
          myEl.scrollIntoView(); 
       $scope.editMe=label;
       $scope.removeItem(x);
       lab=label;
    }

    $scope.editfunc =function(){
      $scope.errortext = "";    
      $http({
    method: 'POST',
    url: '/lab',
    data: "label=" + lab+"&newlabel="+$scope.editMe,
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
}).then(function(response) {  
          if(response.data.length>0)
         $scope.errortext=response.data;
         else{
      $http({
         method: 'post',
         url: '/editlabel',
         data: "old="+lab+"&new="+$scope.editMe,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
     });        
     $('#labels').slideUp(); 
   setInterval(function(){ location.reload(); }, 800);
           
         }
         });
    } 
});


app.controller("mynotiCtrl", function($scope, $http) {
    $scope.no="viewnotitasks/";
    $scope.noo="viewnotiarchivetasks/";
    $scope.notifications=[];
    $scope.notificationstask=[];
    $scope.notificationsarchive=[];
      $http.get("/notifications")
      .then(function(response) {  
          for(var cnt=0;cnt<response.data.length;cnt++){
         $scope.notifications[cnt]=response.data[cnt].taskid;
        }
         notify(response.data);
            $http({
         method: 'post',
         url: '/notidetails',
         data: "data=" + $scope.notifications,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
         }).then(function(response){
             var demo=response.data;

              if(response.data.length == 2 ){
                  if(typeof(response.data[0])!='string' && typeof(response.data[1])!='string'){ 
                for(var ct=0;ct<response.data[0].length ;ct++){
                         var id= demo[0][ct].id;
                          var title=demo[0][ct].title;
                 GetMyResourceDatatask(ct,id,title);
               }
               function GetMyResourceDatatask(ct,id,title){
                            $http({
                                method: 'post',
                                url: '/notitime',
                                data: "data=" + demo[0][ct].id,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                }).then(function(response){
                                    $scope.notificationstask[ct]=({
                                      id:id,
                                     title:title,
                                     time:response.data 
                                });
                        });
    }
             function GetMyResourceDataarchive(ct,id,title){
                               $http({
                                method: 'post',
                                url: '/notitime',
                                data: "data=" + demo[1][ct].id,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                }).then(function(response){
                                     $scope.notificationsarchive[ct]=({
                                      id:id,
                                     title:title,
                                     time:response.data 
                                });
                        });
                  
      

             }
              

                for(var ct=0;ct<response.data[1].length ;ct++){
                          var id= demo[1][ct].id;
                          var title=demo[1][ct].title;
                      GetMyResourceDataarchive(ct,id,title);
            
                           }
          
              }
             else if(response.data[0]=='task') {
                 function GetMyResource(ct,id,title){
                            $http({
                                method: 'post',
                                url: '/notitime',
                                data: "data=" + demo[1][ct].id,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                }).then(function(response){
                                    $scope.notificationstask[ct]=({
                                      id:id,
                                     title:title,
                                     time:response.data 
                                });
                        });
    }
               for(var ct=0;ct<response.data[1].length ;ct++){
                          var id= demo[1][ct].id;
                          var title=demo[1][ct].title;
                 GetMyResource(ct,id,title);
                              
               }
   
             }

             else if(response.data[0]=='archive') {
           
           function GetMyResourcearchive(ct,id,title){
                               $http({
                                method: 'post',
                                url: '/notitime',
                                data: "data=" + demo[1][ct].id,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                }).then(function(response){
                                     $scope.notificationsarchive[ct]=({
                                      id:id,
                                     title:title,
                                     time:response.data 
                                });
                        });
           }
           for(var ct=0;ct<response.data[1].length ;ct++){
                          var id= demo[1][ct].id;
                          var title=demo[1][ct].title;
                      GetMyResourcearchive(ct,id,title);

               }
             
             }
         
         }
       });
 
     });  

$scope.removeNotitask = function (x,task) {
            $http({
         method: 'DELETE',
         url: '/noti',
         data: "task=" + task,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
         });

        $scope.notificationstask.splice(x, 1);
    }
$scope.removeNotiarchive = function (x,task) {
            $http({
         method: 'DELETE',
         url: '/noti',
         data: "task=" + task,
         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
         });

        $scope.notificationsarchive.splice(x, 1);
    }    

});
</script>

<div ng-app="lab" ng-cloak >
 <div ng-controller="myCtrl"  style="max-width:300px;" id="labels">
  <header >
    <h3 id="top">LABELS</h3>
    <hr style="background:white">
  </header>
  <ul style="list-style-type: none; ">
    <li ng-repeat="x in labels" style="margin-bottom:10px;"><i class="fas fa-pen"  style="padding-right:20px;display:inline;cursor:pointer;" ng-click="editItem($index,x)">  </i><span style="cursor:pointer;" class="avail_labels"> <a ng-href='/<%label%><%x%>'> <%x%> </a> </span><span style="color:red;position:absolute;right:25px;font-size:20px;cursor:pointer;" ng-click="removeItem($index,x)" >X</span></li>
    </ul>
        <input placeholder="Add Labels here" ng-model="addMe" ng-style="add" class="add">
   
        <button ng-click="addItem()" style="color:black;background:green"  class="add">Add</button>
    <p style="color:red;padding-left:10px;padding-top:10px"><%errortext%></p>
  <span id="edit"><button id="closeedit" style="color:black;background:red">&times;</button><input type="text" style="width:170px;" ng-model="editMe" id="editval" > <button ng-click="editfunc()" style="color:black;background:green">EDIT</button></span>


</div>


<div  ng-controller="mynotiCtrl"  style="max-width:300px;height=300px;" id="notifications">
  
   <header >
    <h3 id="top">NOTIFICATIONS</h3>
    <hr style="background:white">
  </header>
 
 <ul style="list-style-type: none; ">
    <li ng-repeat="x in notificationstask " style="margin-bottom:10px;"><span style="color:red;position:absolute;right:25px;font-size:20px;cursor:pointer;" ng-click="removeNotitask($index,x.id)" >X</span>  <a ng-href='/<%no%><%x.id%>'><%x.title%> </a>   <br> <%x.time%> </li>
    <li ng-repeat="x in notificationsarchive " style="margin-bottom:10px;"><span style="color:red;position:absolute;right:25px;font-size:20px;cursor:pointer;" ng-click="removeNotiarchive($index,x.id)" >X</span>  <a ng-href='/<%noo%><%x.id%>'><%x.title%> </a> <br> <%x.time%></li>
   
    </ul>
  </div>



  </div>


