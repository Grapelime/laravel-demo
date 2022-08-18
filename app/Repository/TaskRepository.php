<?php

 namespace App\Repository;

 use App\Models\Task;

















































 use App\Models\User;

 class TaskRepository
 {
     protected $task;

     public function __construct(Task $task)
     {
         $this->TaskObject=$task;
     }

     /**
      * fetch all task details and name of users for task assignment
      * @return \Illuminate\Http\Response
      */
     public function viewtask()
     {
         $data = $this->TaskObject->paginate(5);
         foreach ($data as $datas) {
             $pieces = explode(" ", $datas->updated_at);
             $length=sizeof($pieces);
             if ($length>=2) {
                 $datas->date_updated=$pieces['0'];
             }
             $datas->updated_at_date=date('d-m-Y', strtotime($datas->date_updated));
             $id=$datas->assigned_to;
             $name= User::select('name')->where('id', '=', $id)->first();
             $datas->assigned_to = $name;
         }
         return $data;
     }

     /**
      * insert new task in to database
      *  @param  \Illuminate\Http\Request  $data
      */
     public function addtasks($data)
     {
         $validator=$data->validate([
            'title' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'status' =>'required',
            'assignedto'=>'required',

        ]);
         if ($validator) {
             $datas = $this->TaskObject;
             $datas['title'] = $data['title'];
             $datas['description'] = $data['description'];
             $datas['due_date'] = $data['duedate'];
             $datas['status'] = $data['status'];
             $datas['assigned_to'] = $data['assignedto'];
             $datas['updated_time'] = $data['created_time'];
             $datas->save();
             $result= $datas->fresh();
             if ($result) {
                 session()->flash('success', 'User successfully updated');
                 return $result;
             }
         }
     }

     /**
      * returns details of a specified task
      * @return \Illuminate\Http\Response
      */
     public function edittask($id)
     {
         $data= $this->TaskObject->find($id);
         $id=$data->assigned_to;
         $name= User::select('name', 'id')->where('id', '=', $id)->first();
         $data->assigned_to_name = $name->name;
         $data->assigned_to_id = $name->id;
         return $data;
     }

     /**
      * updates details of a specified task
      * @param  \Illuminate\Http\Request  $data
      * @param Models\Task $id
      */
     public function edittasks($data, $id)
     {
         $validator=$data->validate([
            'title' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'status' =>'required',
            'assignedto'=>'required',

        ]);
         if ($validator) {
             $datas = $this->TaskObject->find($id);
             $datas['title'] = $data['title'];
             $datas['description'] = $data['description'];
             $datas['due_date'] = $data['duedate'];
             $datas['status'] = $data['status'];
             $datas['assigned_to'] = $data['assignedto'];
             $datas->update();
             $result= $datas->fresh();
             if ($result) {
                 session()->flash('success', 'Task successfully updated');
                 return $result;
             }
         }
     }

     /**
      * deletes a specified task from database
      * @return \Illuminate\Http\Response
      */
     public function deletetask($id)
     {
         return $this->TaskObject->destroy($id);
     }

     /**
      * fetch all tasks of a login user
      * @return \Illuminate\Http\Response
      */
     public function usertasklist()
     {
         return $data=$this->TaskObject->where('assigned_to', '=', \Auth::id())->get();
     }

     /**
      * fetch details of a task specified by the user
      * @param Models\Task $id
      * @return \Illuminate\Http\Response
      */
     public function fetchtaskdata($id)
     {
         $data=$this->TaskObject->find($id);
         $pieces = explode(" ", $data->updated_at);
         $length=sizeof($pieces);
         if ($length>=2) {
             $data->date_updated=$pieces['0'];
             $data->time_updated=$pieces['1'];
         }
         $data->updated_at_date=date('d-m-Y', strtotime($data->date_updated));
         $data->updated_at_time=date('h:i A', strtotime($data->time_updated));
         return $data;
     }

     /**
      * update status of a task specified by user
      * @param Models\Task $id
      * @param  \Illuminate\Http\Request  $data
      */
     public function updatestatus($request, $id)
     {
         if ($request->status!="") {
             $data=$this->TaskObject->find($id);
             $data->status=$request->status;
             $data->updated_time = $request->created_time;
             $data->update();
             $result= $data->fresh();
             return $result;
         }
     }
 }
