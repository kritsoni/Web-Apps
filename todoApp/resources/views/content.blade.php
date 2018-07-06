<div class="container content">
<div class="input">
  <form>
  {!! csrf_field() !!}

    <div class="form-group mb-0 ">
      <input type="text" class="form-control round" id="note" name='title' placeholder="CREATE A NOTE" autocomplete="off" >
    </div>
     <div class="form-group mt-0 ">
    <textarea class="form-control rnd" rows="5" id="desc" name="description" placeholder="DESCRIPTION"></textarea>
    </div>
  
    </form>
</div>
   <div style="padding-top: 40px;" class="data">
    @foreach($tasks as $task)
        @if($task->pin == 1)  
          <h1>PINNED:</h1>
          @break
        @endif
        @endforeach
    @foreach($tasks as $task)
      @if($task->pin == 1)  
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
           <input type="hidden" id="type"  value='task'>    
        <input type="hidden" id="id"  value={{$task->id}}>       
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span>
         </div>
          
        @elseif($task->description!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>            
         <input type="hidden" id="type"  value='task'>    
         <input type="hidden" id="id"  value={{$task->id}}>    
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
        @endif
     @endif
     <div class="options" style='border:{{$task->frmcolor}};border-top:none;'>
      <span><i class="fas fa-thumbtack pin"></i><i class="fas fa-trash-alt option trash" style="margin-left:6px;"></i> <i class="fas fa-palette bgcolor"></i> <i class="fas fa-pen txtcolor"></i> <i class="fas fa-archive arch"></i> <img src="css/blank-square.png" class=" frame" style="margin-top:-1px;margin-left:3px;margin-right:3px"> <i class="fas fa-tags tag"></i> <i class="fas fa-clock remind"></i></span>
     </div>   
   </div> 
   @endif
    @endforeach
   
</div>

   <div style="padding-top: 40px;" class="data">
      @foreach($tasks as $task)
        @if($task->pin == 0)  
            <h1>OTHERS:</h1>
            @break
        @endif
      @endforeach  
   
    
    @foreach($tasks as $task)
      @if($task->pin == 0)  
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
           <input type="hidden" id="type"  value='task'>    
        <input type="hidden" id="id"  value={{$task->id}}>       
         <span class='title' style='color:{{$task->txtcolor}};'>{{$task->title}}</span>
         </div>
          
        @elseif($task->description!= null)
         <div class='notes'  style='background-color:{{$task->bgcolor}};border:{{$task->frmcolor}};'>            
         <input type="hidden" id="type"  value='task'>    
         <input type="hidden" id="id"  value={{$task->id}}>    
         <span class='description' style='color:{{$task->txtcolor}};'>{{$task->description}}  </span>
        </div>
        @endif
     @endif
     <div class="options" style='border:{{$task->frmcolor}};border-top:none;'>
      <span><i class="fas fa-thumbtack pin"></i><i class="fas fa-trash-alt option trash" style="margin-left:6px;"></i> <i class="fas fa-palette bgcolor"></i> <i class="fas fa-pen txtcolor"></i> <i class="fas fa-archive arch"></i> <img src="css/blank-square.png" class=" frame" style="margin-top:-1px;margin-left:3px;margin-right:3px"> <i class="fas fa-tags tag"></i> <i class="fas fa-clock remind"></i></span>
     </div>   
   </div> 
   @endif
    @endforeach
   
</div>

  <div class="modal"  >
    <div class="modal-dialog" >
      <div class="modal-content" >
      
        <div class="modal-body" id="bdy">
       <div>
     </div>
         

        </div>
        
        
      </div>
    </div>
  </div>
   
   

</div>
  </div>