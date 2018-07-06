<h1>IN TRASH</h1>
<div style="padding-top: 40px;">
    @foreach($tasks as $task)
    <div class="note">
        @if($task->title!= null && $task->description!=null)
         <div class='notes' style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'> 
         <input type="hidden" id="id"  value={{$task->id}}>    
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span> 
         <hr>
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
   
        @elseif($task->title!= null || $task->description!=null)
          @if($task->title!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>         
          <input type="hidden" id="id"  value={{$task->id}}>       
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span>
         </div>
          
        @elseif($task->description!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>            
         <input type="hidden" id="id"  value={{$task->id}}>    
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
        @endif
     @endif
       <div class="options" style='border:{{$task->frmcolor}};border-top:none;'>
      <span> <i class="fas fa-trash-alt trash2" style="padding-top:5px"></i> <i class="fas fa-arrow-alt-circle-up restore" style="float:right;padding-top:5px"></i></span>
     </div>   
   </div>   
    @endforeach
   
</div>
