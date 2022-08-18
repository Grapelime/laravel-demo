<?php
namespace App\Services;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;

class UserService{


   protected $UserRepository;
   public function __construct(UserRepository $UserRepository,TaskRepository $taskrepository){
      $this->UserRepository=$UserRepository;
      $this->taskrepository=$taskrepository;
   }
      /**
       * @return \Illuminate\Http\Response
       * get details of all users
       */
      public function getall(){
      return  $this->UserRepository->getallusers();
      }

      /**
       * @return \Illuminate\Http\Response
       * @param Model\User id
       * deletes specified user
       */
      public function delete($id){
        return  $this->UserRepository->delete($id);
      }

      /**
       * @return \Illuminate\Http\Response
       * @param Model\User id
       * returns details of a specified user
       */
      public function edit($id){
        return  $this->UserRepository->edit($id);
      }
      
      /**
       * takes data from form and updates specified user details
       * @param  \Illuminate\Http\Request  $request
       * @param  \App\Models\User $id
       */
      public function update($id,$request){
        return  $this->UserRepository->update($id,$request);
      }
      
      /**
       * returns details of all task
       * @return \Illuminate\Http\Response
       */
      public function viewtask(){
        return  $this->taskrepository->viewtask();
      } 
      
      /**
       * returns names of all users
       * @return \Illuminate\Http\Response
       */  
      public function getusernames(){
        return  $this->UserRepository->getusernames();
      } 
      
      /**
       * @param  \Illuminate\Http\Request  $request
       * creates new tasks
       */
      public function addtasks($request){
        return  $this->taskrepository->addtasks($request);
      }
      
      /**
       * fetch details of specified task
       * @return \Illuminate\Http\Response
       */
      public function edittask($id){
        return  $this->taskrepository->edittask($id);
      }
      
      /**
       * updates details of specified task
       * @param  \Illuminate\Http\Request  $request
       */
      public function edittasks($request,$id){
        return $this->taskrepository->edittasks($request,$id);
      }
      
      /**
       *  deletes specified task
       *  @return \Illuminate\Http\Response
       */
      public function deletetask($id){
        return $this->taskrepository->deletetask($id);
      }
      
      /**
       * @param  \Illuminate\Http\Request  $request
       * takes required credantials and updates the password
       */
      public function resetpassword($request){
        return $this->UserRepository->resetpassword($request);
      }
      
      /**
       * fetch all task details  according to login user
       * @return \Illuminate\Http\Response
       */
      public function usertasklist(){
        return $this->taskrepository->usertasklist();
      }
      
      /**
       * fetch details of a specified task only of all tasks of a user
       * @return \Illuminate\Http\Response
       * @param Model\Task $id
       */
      public function fetchtaskdata($id){
        return $this->taskrepository->fetchtaskdata($id);    
      }
      
      /**
       * @param  \Illuminate\Http\Request  $request
       * update status of a specified task assigned to specified login user
       */
      public function updatestatus($request,$id){
        return $this->taskrepository->updatestatus($request,$id);    
      }
}

?>