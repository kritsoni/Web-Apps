<div style="padding-top: 40px;" class="data">
<div class="note">
        @if($id->title!= null && $id->description!=null)
         <div class='notes' style='background-color:{{$id->bgcolor}};border:{{$id->frmcolor}};'> 
         <input type="hidden" id="id"  value={{$id->id}}>
         <input type="hidden" id="type"  value={{$type}}>    
         <span class='title' style='color:{{$id->txtcolor}};'>{{$id->title}}</span> 
         <hr>
         <span class='description' style='color:{{$id->txtcolor}};'>{{$id->description}}  </span>
        </div>
   
        @elseif($id->title!= null || $id->description!=null)
          @if($id->title!= null)
         <div class='notes'  style='background-color:{{$id->bgcolor}};border:{{$id->frmcolor}};'>         
          <input type="hidden" id="id"  value={{$id->id}}>
          <input type="hidden" id="type"  value={{$type}}>         
         <span class='title' style='color:{{$id->txtcolor}};'>{{$id->title}}</span>
         </div>
          
        @elseif($id->description!= null)
         <div class='notes'  style='background-color:{{$id->bgcolor}};border:{{$id->frmcolor}};'>            
         <input type="hidden" id="id"  value={{$id->id}}>
         <input type="hidden" id="type"  value={{$type}}>      
         <span class='description' style='color:{{$id->txtcolor}};'>{{$id->description}}  </span>
        </div>
        @endif
     @endif
     <div class="options" style='border:{{$id->frmcolor}};border-top:none;'>
      <span><i class="fas fa-thumbtack pin"></i> <i class="fas fa-trash-alt option trash" style="margin-left:6px;"></i> <i class="fas fa-palette bgcolor"></i> <i class="fas fa-pen txtcolor"></i> <i class="fas fa-archive {{$isarch}}"></i> <img src="/css/blank-square.png" class=" frame" style="margin-top:-1px;margin-left:3px;margin-right:3px"> <i class="fas fa-tags tag"></i> <i class="fas fa-clock remind"></i></span>
     </div>   
   </div> 
   
</div>
</div>

<div class="modal"  >
    <div class="modal-dialog" >
      <div class="modal-content" >
      
        
        <div class="modal-body" id="bdy">
         

        </div>
        
        
      </div>
    </div>
  </div>