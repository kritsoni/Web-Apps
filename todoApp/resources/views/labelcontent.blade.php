
@if(gettype(json_decode($response)[0][0])=='string' && gettype(json_decode($response)[1][0])=='string')
    <h1>NO NOTES WITH THIS LABEL</h1>
@else
@if(gettype(json_decode($response)[0][0])=='object')
 <div style="padding-top: 40px;" class="data">
    @foreach(json_decode($response)[0] as $task)
        
    <div class="note">
        @if($task->title!= null && $task->description!=null)
         <div class='notes' style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'> 
         <input type="hidden" id="id"  value={{$task->id}}>
         <input type="hidden" id="type"  value='task'>    
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span> 
         <hr>
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
   
        @elseif($task->title!= null || $task->description!=null)
          @if($task->title!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>         
          <input type="hidden" id="id"  value={{$task->id}}>
          <input type="hidden" id="type"  value='task'>         
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span>
         </div>
          
        @elseif($task->description!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>            
         <input type="hidden" id="id"  value={{$task->id}}>
         <input type="hidden" id="type"  value='task'>      
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
        @endif
     @endif
     <div class="options" style='border:{{$task->frmcolor}};border-top:none;'>
      <span> <i class="fas fa-trash-alt option trash" style="margin-left:6px;"></i> <i class="fas fa-palette bgcolor"></i> <i class="fas fa-pen txtcolor"></i> <i class="fas fa-archive arch"></i> <img src="/css/blank-square.png" class=" frame" style="margin-top:-1px;margin-left:3px;margin-right:3px"> <i class="fas fa-tags tag"></i> <i class="fas fa-clock remind"></i></span>
     </div>   
   </div> 
    @endforeach
   
</div>
@endif
@if(gettype(json_decode($response)[1])=='object'|| gettype(json_decode($response)[1][0])=='object')
<h1>IN ARCHIVE:-</h1>
 <div style="padding-top: 40px;" class="data">
    @foreach(json_decode($response)[1] as $task)
    <div class="note">
        @if($task->title!= null && $task->description!=null)
         <div class='notes' style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'> 
         <input type="hidden" id="id"  value={{$task->id}}>
         <input type="hidden" id="type"  value='archive'>      
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span> 
         <hr>
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
   
        @elseif($task->title!= null || $task->description!=null)
          @if($task->title!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>         
          <input type="hidden" id="id"  value={{$task->id}}>
          <input type="hidden" id="type"  value='archive'>       
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span>
         </div>
          
        @elseif($task->description!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>            
         <input type="hidden" id="id"  value={{$task->id}}>
         <input type="hidden" id="type"  value='archive'>    
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
        @endif
     @endif
     <div class="options" style='border:{{$task->frmcolor}};border-top:none;'>
      <span> <i class="fas fa-trash-alt option trash" style="margin-left:6px;"></i> <i class="fas fa-palette bgcolor"></i> <i class="fas fa-pen txtcolor"></i> <i class="fas fa-archive unarch"></i> <img src="/css/blank-square.png" class=" frame" style="margin-top:-1px;margin-left:3px;margin-right:3px"> <i class="fas fa-tags tag"></i> <i class="fas fa-clock remind"></i></span>
     </div>   
   </div> 
    @endforeach
   
</div>
@endif

  <div class="modal"  >
    <div class="modal-dialog" >
      <div class="modal-content" >
      
        
        <div class="modal-body" id="bdy">
         

        </div>
        
        
      </div>
    </div>
  </div>
@endif
