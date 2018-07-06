<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Task;
use App\Trash;
use App\Archive;
use App\Label;
use App\Reminder;
use Requests;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function create(Request $request)
    {
        $todo = new Task;
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->save();
    }

    public function update(Request $request)
    {
         $todo = Task::findOrFail($request->id);
         $todo->title = $request->input('title');
         $todo->description = $request->input('description');
         $todo->save();
   
    }

    public function delete(Request $request)
    {
         $todo = Task::findOrFail($request->id);
         DB::table('trashes')->insert(['id' => $todo->id,	'title'=>$todo->title,
         'description'=> $todo->description,'bgcolor'=>$todo->bgcolor,'txtcolor'=>$todo->txtcolor,
          'frmcolor'=>$todo->frmcolor,'labels'=>$todo->labels,'created_at'=>$todo->created_at,'updated_at'=>$todo->updated_at]);
         $todo->delete();   
    }
     

    public function updatebg(Request $request)
    {
         $todo = Task::findOrFail($request->id);
         $todo->bgcolor = $request->color;
         $todo->save();
   
    }
    
    public function updatefg(Request $request)
    {
         $todo = Task::findOrFail($request->id);
         $todo->txtcolor = $request->color;
         $todo->save();
   
    }
    
    public function updatefrm(Request $request)
    {
         $todo = Task::findOrFail($request->id);
         $todo->frmcolor = $request->color;
         $todo->save();
   
    }
    public function trash(){
        $tasks =Trash::all();
        return view('trash',compact('tasks'));
    }

    public function trashdelete(Request $request){
        $todo = Trash::findOrFail($request->id);
        $todo->delete();   
       
    }

    public function trashrestore(Request $request){
         $todo = Trash::findOrFail($request->id);
         DB::table('tasks')->insert(['id' => $todo->id,	'title'=>$todo->title,
         'description'=> $todo->description,'bgcolor'=>$todo->bgcolor,'txtcolor'=>$todo->txtcolor,
          'frmcolor'=>$todo->frmcolor,'labels'=>$todo->labels,'created_at'=>$todo->created_at,'updated_at'=>$todo->updated_at]);
         $todo->delete();   
   
    }

    public function archive(){
        $tasks =Archive::all();
        return view('archive',compact('tasks'));
    }
    
    public function archivedelete(Request $request){

        $todo = Task::findOrFail($request->id);
        DB::table('archives')->insert(['id' => $todo->id,	'title'=>$todo->title,
        'description'=> $todo->description,'bgcolor'=>$todo->bgcolor,'txtcolor'=>$todo->txtcolor,
         'frmcolor'=>$todo->frmcolor,'labels'=>$todo->labels,'created_at'=>$todo->created_at,'updated_at'=>$todo->updated_at]);
        $todo->delete();   
  
    }

    public function delarch(Request $request)
    {
         $todo = Archive::findOrFail($request->id);
         DB::table('trashes')->insert(['id' => $todo->id,	'title'=>$todo->title,
         'description'=> $todo->description,'bgcolor'=>$todo->bgcolor,'txtcolor'=>$todo->txtcolor,
          'frmcolor'=>$todo->frmcolor,'labels'=>$todo->labels,'created_at'=>$todo->created_at,'updated_at'=>$todo->updated_at]);
         $todo->delete();   
    }

    public function updatebgarch(Request $request)
    {
         $todo = Archive::findOrFail($request->id);
         $todo->bgcolor = $request->color;
         $todo->save();
   
    }
     
    public function updatefgarch(Request $request)
    {
         $todo = Archive::findOrFail($request->id);
         $todo->txtcolor = $request->color;
         $todo->save();
   
    }
   
    public function updatefrmarch(Request $request)
    {
         $todo = Archive::findOrFail($request->id);
         $todo->frmcolor = $request->color;
         $todo->save();
   
    }

    public function archiveinsert(Request $request){

        $todo = Archive::findOrFail($request->id);
        DB::table('tasks')->insert(['id' => $todo->id,	'title'=>$todo->title,
        'description'=> $todo->description,'bgcolor'=>$todo->bgcolor,'txtcolor'=>$todo->txtcolor,
         'frmcolor'=>$todo->frmcolor,'labels'=>$todo->labels,'created_at'=>$todo->created_at,'updated_at'=>$todo->updated_at]);
        $todo->delete();   
  
    }

    public function updatearch(Request $request)
    {
         $todo = Archive::findOrFail($request->id);
         $todo->title = $request->input('title');
         $todo->description = $request->input('description');
         $todo->save();
   
    }
    public function label(Request $request){
        $label = new Label;
        $label->label = $request->label;
        $label->save();
    }
    
    public function alllabels(){
        $label =Label::all();
         echo $label;    
    }
    
    public function dellabel(Request $request)
    {
         $label = Label::where('label', $request->label);
         $label->delete();   
    }

    public function uptlabel(Request $request)
    {
        
        $lab = Label::where('label', $request->label)->get()->first();
        $lab2 = Label::where('label', $request->newlabel)->get()->first();
        if($lab2 == "" || $lab2->id == $lab->id)
         {
         $lab->label = $request->newlabel;
          $lab->save();
         }
         else {
            echo"label exists";
        }
      
   }

   public function add_labels(Request $request){
    if(sizeof(json_decode($request->labels))>0){
    $todo = Task::findOrFail($request->id);
    $newarray=json_decode($request->labels);
    if($todo->labels == NULL){
        $todo->labels=json_encode($newarray);
        $todo->save();     
    }   
    else { 
    $array=json_decode($todo->labels);
     $len = sizeof($array);
      for($i=0;$i<sizeof($newarray);$i++){
          $array[$len+$i]=$newarray[$i];
      }
    
       $todo->labels=json_encode($array);
       $todo->save();
      }
    }
 } 
 
 public function  add_labelsarch(Request $request){
    if(sizeof(json_decode($request->labels))>0){
    $todo = Archive::findOrFail($request->id);
    $newarray=json_decode($request->labels);
    if($todo->labels == NULL){
        $todo->labels=json_encode($newarray);
        $todo->save();     
    }   
    else { 
    $array=json_decode($todo->labels);
     $len = sizeof($array);
      for($i=0;$i<sizeof($newarray);$i++){
          $array[$len+$i]=$newarray[$i];
      }
    
       $todo->labels=json_encode($array);
       $todo->save();
      }
    }
 }
 public function delfromlabel(Request $request){

    $label = $request->label;
    $tasks=Task::all();
    $archives=Archive::all();
    $trashes=Trash::all();
     
    foreach($tasks as $task){
        $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
        for($i=0;$i<sizeof($lab);$i++){
            $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
        }  
          if(in_array($label,$lab)){
             $pos = array_search($label,$lab);
             array_splice($lab,$pos,1);             
              $task->labels=json_encode($lab);
              $task->save();
        
       }
    }

    foreach($archives as $task){
        $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
        for($i=0;$i<sizeof($lab);$i++){
            $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
        }  
          if(in_array($label,$lab)){
             $pos = array_search($label,$lab);
             array_splice($lab,$pos,1);             
              $task->labels=json_encode($lab);
              $task->save();
        
       }
    }

    foreach($trashes as $task){
        $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
        for($i=0;$i<sizeof($lab);$i++){
            $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
        }  
          if(in_array($label,$lab)){
             $pos = array_search($label,$lab);
             array_splice($lab,$pos,1);             
              $task->labels=json_encode($lab);
              $task->save();
        
       }
    }
 }

 public function editlabels(Request $request){

    $label = $request->old;
    $tasks=Task::all();
    $archives=Archive::all();
    $trashes=Trash::all();
     
    foreach($tasks as $task){
        $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
        for($i=0;$i<sizeof($lab);$i++){
            $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
        }  
          if(in_array($label,$lab)){
             $pos = array_search($label,$lab);
             $lab[$pos]=$request->new;
              $task->labels=json_encode($lab);
              $task->save();
        
       }
    }

    foreach($archives as $task){
        $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
        for($i=0;$i<sizeof($lab);$i++){
            $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
        }  
          if(in_array($label,$lab)){
             $pos = array_search($label,$lab);
             $lab[$pos]=$request->new;             
              $task->labels=json_encode($lab);
              $task->save();
        
       }
    }

    foreach($trashes as $task){
        $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
        for($i=0;$i<sizeof($lab);$i++){
            $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
        }  
          if(in_array($label,$lab)){
             $pos = array_search($label,$lab);
             $lab[$pos]=$request->new;             
              $task->labels=json_encode($lab);
              $task->save();
        
       }
    }
 }

        public function onlylabels(Request $request){
            $label =Label::all()->pluck('label')->toArray();
             $task = Task::findOrFail($request->id);
             $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
             for($i=0;$i<sizeof($lab);$i++){
                $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
             }  
            echo json_encode(array_diff($label,$lab));
              
        }

        public function onlylabel(Request $request){
            $label =Label::all()->pluck('label')->toArray();
            $task = Archive::findOrFail($request->id);
            $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
            for($i=0;$i<sizeof($lab);$i++){
               $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
            }  
           echo json_encode(array_diff($label,$lab));
          }


          public function onlylabs(Request $request){
             $label =DB::table('tasks')->select('labels')->where('id', $request->id)->get();
             $res=$label->all()[0]->labels;
             $lab=explode(',',substr($res,1,strlen($res)-2));
            for($i=0;$i<sizeof($lab);$i++){
               $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
            }  
           echo json_encode($lab);
        }

         public function onlylab(Request $request){
            $label =DB::table('archives')->select('labels')->where('id', $request->id)->get();
            $res=$label->all()[0]->labels;
            $lab=explode(',',substr($res,1,strlen($res)-2));
           for($i=0;$i<sizeof($lab);$i++){
              $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
           }  
          echo json_encode($lab);
         }
        
         public function removelabel(Request $request){
            $todo = Task::findOrFail($request->id);
            $label =DB::table('tasks')->select('labels')->where('id', $request->id)->get();
            $res=$label->all()[0]->labels;
            $lab=explode(',',substr($res,1,strlen($res)-2));
            for($i=0;$i<sizeof($lab);$i++){
               $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
            }
            $rem_lab=$request->label;
           
            if(in_array($rem_lab,$lab)){
                  $pos = array_search($rem_lab,$lab);
                  array_splice($lab,$pos,1); 
                  $todo->labels=json_encode($lab);
                  $todo->save();
           
          }
        }

        public function removelabelarch(Request $request){
            $todo = Archive::findOrFail($request->id);
            $label =DB::table('archives')->select('labels')->where('id', $request->id)->get();
            $res=$label->all()[0]->labels;
            $lab=explode(',',substr($res,1,strlen($res)-2));
            for($i=0;$i<sizeof($lab);$i++){
               $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
            }
            $rem_lab=$request->label;
           
            if(in_array($rem_lab,$lab)){
                 $pos = array_search($rem_lab,$lab);
                 array_splice($lab,$pos,1);             
                 $todo->labels=json_encode($lab);
                 $todo->save();
           
          }
        }


        public function viewlabeltasks($label){

             $tasks=Task::all();
            $archives=Archive::all();
            $fromtasks=[];
            $fromarchives=[];
            $response=[];  
            $cnt1=0;
            foreach($tasks as $task){
                $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
                for($i=0;$i<sizeof($lab);$i++){
                    $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
                }  
                  if(in_array($label,$lab)){
                     $fromtasks[$cnt1++]=$task;
                  }
               
            }
        if(!count($fromtasks))
          $fromtasks[0]="none";

        foreach($archives as $task){
            $lab=explode(',',substr($task->labels,1,strlen($task->labels)-2));
            for($i=0;$i<sizeof($lab);$i++){
                $lab[$i]=substr($lab[$i],1,strlen($lab[$i])-2);
            }  
            if(in_array($label,$lab)){
                $fromarchives[$cnt1++]=$task;
             }
          
        }

        if(!count($fromarchives))
          $fromarchives[0]="none";

        $response[0]=$fromtasks;
        $response[1]=$fromarchives;
        $response=json_encode($response);
        return view('showlabels',compact('response'));
         }  



         public function addreminder(Request $request){
            date_default_timezone_set("Asia/Kolkata");
          $find=sizeof(Reminder::where('taskid',$request->id)->get());
          $d=strtotime($request->date);
          $d=date("d-m-Y",$d);
          $t=strtotime($request->time);
          $t=date("h:i:sa",$t);
          if($find == 0){
                
                $rem = new Reminder;
                $rem->taskid =  $request->id;
                $rem->remdate = $d;
                $rem->remtime = $t;
                $rem->readed = 0;
                $rem->save();
         }
           else{
                $id = Reminder::where('taskid',$request->id)->get()[0]->id;
                $find = Reminder::findOrFail($id);
                $find->remdate = $d;
                $find->remtime = $t;
                $find->readed =0;
                $find->noti=1;
                $find->save();
           }
        }

        public function getnotifications(){
               date_default_timezone_set("Asia/Kolkata");
            $notification =DB::table('reminders')->select('taskid','id')->where('remdate','<=',date('d-m-Y'))->where('remtime','<=',date('h:i:sa'))->where('noti',1)->get();
            echo $notification;
          
             
        }

        public function getnonotifications(){
            date_default_timezone_set("Asia/Kolkata");
            $notification =DB::table('reminders')->select('taskid')->where('remdate','<=',date('d-m-Y'))->where('remtime','<=',date('h:i:sa'))->where('readed',0)->get();
            $notification=$notification->count();
            echo $notification;
        }
        
        public function makeread(Request $request){
            $no_noti = $request->noti;  
          foreach($no_noti as $n){
            $t = Reminder::findOrFail($n['id']);
            $t->readed = 1;
            $t->save();
          }
        }

        public function removenotifications(Request $request){
            $noti = $request->task;  
            $t = Reminder::where('taskid',$noti)->get()[0];
            $t->noti=0;
            $t->save();      
        }
    
        public function noti(){
            $rems =Reminder::all()->all();
            $task=[];
            $arch=[];
            $cnt1=0;
            $cnt2=0;
            foreach($rems as $n){
                if(Task::find($n->taskid)!=null)
                 $task[$cnt1++] = Task::find($n->taskid);
                 }
           foreach($rems as $n){
                if(Archive::find($n->taskid)!=null)
                    $arch[$cnt2++] = Archive::find($n->taskid);
                 }
           if(sizeof($task)>0 && sizeof($arch)>0){
              $tasks[0]=$task;
              $tasks[1]=$arch;
           }
           else if(sizeof($task)>0){
             $tasks[0]='task';
             $tasks[1]=$task;
            }
           else if(sizeof($arch)>0){
             $tasks[0]='archive';
             $tasks[1]=$arch;
            }
           else
             $tasks=[];   
            return view('reminder',compact('tasks'));
        }


        public function notidetails(Request $request){
            $rems=explode(',',$request->data) ;
            $task=[];
            $arch=[];
            $cnt1=0;
            $cnt2=0;
            foreach($rems as $n){
                if(Task::find($n)!=null)
                 $task[$cnt1++] = Task::find($n);
                 }
          
           foreach($rems as $n){
                if(Archive::find($n)!=null)
                    $arch[$cnt2++] = Archive::find($n);
                 }
           if(sizeof($task)>0 && sizeof($arch)>0){
              $tasks[0]=$task;
              $tasks[1]=$arch;
           }
           else if(sizeof($task)>0){
             $tasks[0]='task';
             $tasks[1]=$task;
            }
           else if(sizeof($arch)>0){
             $tasks[0]='archive';
             $tasks[1]=$arch;
            }
           else
             $tasks=[];   
            
             echo json_encode($tasks);
            }
   
            public function notitime(Request $request){
                $noti;
                $id=$request->data;
                if(sizeof(Reminder::where('taskid',$id)->get())>0){
                $date=Reminder::where('taskid',$id)->get()[0]->remdate;
                $time=Reminder::where('taskid',$id)->get()[0]->remtime;
                $noti=$date.':'.$time;
                echo $noti;
             }
              else 
                echo "";
            }
            public function viewnotitasks(Task $id){
             $type="task";
             $isarch="arch";
            return view('shownoti',compact(['id','type','isarch']));
            }
            
            public function viewnotiarchivetasks(Archive $id){
                $type="archive";
                $isarch='unarch';
                return view('shownoti',compact(['id','type','isarch']));
            }

            public function search(Request $request){

                 $val=Input::get('search');
                 if($val == ""){
                    return redirect('/');
                 }
                 $task=Task::where('title','like','%'.$val.'%')->get();
                $archive=Archive::where('title','like','%'.$val.'%')->get();
                $response=[$task,$archive];
                $response=json_encode($response);
                return view('search',compact('response')) ;           
            }
           public function removenoti(Request $request){
                $id=$request->id;
                Reminder::where('taskid',$id)->delete();
           }

           public function pinunpin(Request $request){
               $id=$request->id;
               $todo = Task::findOrFail($request->id);
               if($todo->pin == 0){
               $todo->pin =1;
               $todo->save();
               }
               else if($todo->pin == 1){
                $todo->pin =0;
                $todo->save();
                }
                
           }

           public function pin(Request $request){
            $todo = Archive::findOrFail($request->id);
            DB::table('tasks')->insert(['id' => $todo->id,	'title'=>$todo->title,
            'description'=> $todo->description,'bgcolor'=>$todo->bgcolor,'txtcolor'=>$todo->txtcolor,
            'frmcolor'=>$todo->frmcolor,'labels'=>$todo->labels,'created_at'=>$todo->created_at,'updated_at'=>$todo->updated_at,'pin'=>1]);
            $todo->delete();   
        
        }

        } 

