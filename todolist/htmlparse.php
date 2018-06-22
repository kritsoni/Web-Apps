<?php
function str($string, $substring) {
    $s = 0;
    $i = 0;
    while(is_integer($i)) {   
      $i = stripos($string, $substring, $s);
      if(is_integer($i)) {
        $StrPos[] = $i;
        $s = $i + strlen($substring);
      }
    } 
    if(isset($StrPos)) {
      return $StrPos;
    } else {
      return false;
    }
  }
  
$len1=strlen('TITLE:-</span><p class="in">');
$len2=strlen('DESCRIPTION:-</span><p class="in">');
$len3=strlen('DATE:-</span><p class="in">');
$len4=strlen('PRIORITY:-</span><p class="in">');
$len5=strlen('created-on:-</span><p class="in">');  
$htm = $_POST['html'];

$arr1 = str($htm,'TITLE:-</span><p class="in">');
$arr2 = str($htm,'DESCRIPTION:-</span><p class="in">');
$ar3 = substr(substr($htm,join(str($htm,'DATE:-</span><p class="in">'))),$len3);
$ar4 = substr(substr($htm,join(str($htm,'PRIORITY:-</span><p class="in">'))),$len4);
$ar5 = substr(substr($htm,join(str($htm,'created-on:-</span><p class="in">'))),$len5);
$cnt=0;

$len = sizeof($arr1);
if($len>1){
while($cnt<$len){
    $ar1[$cnt]=substr(substr($htm,$arr1[$cnt]),$len1);
    $ar2[$cnt]=substr(substr($htm,$arr2[$cnt]),$len2);
    $cnt++;
}
}
else{
    $ar1 = substr(substr($htm,join(str($htm,'TITLE:-</span><p class="in">'))),$len1);
    $ar2 = substr(substr($htm,join(str($htm,'DESCRIPTION:-</span><p class="in">'))),$len2);
              
}

$cnt=0;
if($len>1){
while($cnt<$len){
   $ar1[$cnt]= substr($ar1[$cnt],0,strpos($ar1[$cnt], '</p>'));  
   $ar2[$cnt]= substr($ar2[$cnt],0,strpos($ar2[$cnt], '</p>'));  
   $cnt++;
}
}
else{
    $ar1= substr($ar1,0,strpos($ar1, '</p>'));  
    $ar2= substr($ar2,0,strpos($ar2, '</p>'));   
}

$ar3= substr($ar3,0,strpos($ar3, '</p>'));  
$ar4= substr($ar4,0,strpos($ar4, '</p>'));  
$ar5= substr($ar5,0,strpos($ar5, '</p>'));  
$arr=[$ar1,$ar2,$ar3,$ar4,$ar5];
echo json_encode($arr);

?>