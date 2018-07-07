<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Requests;
class restController extends Controller
{
    public function read(){

        $tasks =Task::all();
        return $tasks;
    }

    public function readsingle(Task $id){

        return $id;
    }

    public function create(Request $request){
        $todo = new Task;
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();
    }
    
    public function update(Task $id,Request $request){
        $id->title = $request->title;
        $id->description = $request->description;
        $id->save();
    }

    public function delete(Task $id){
        $id->delete();
    }
}