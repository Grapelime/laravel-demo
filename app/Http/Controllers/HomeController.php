<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Services\UserService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $data;
    
    /**
     *    
     *    by constructing middle ware 'auth' all functions can only be access by authenticated users
     *    the $data variable is an object of user services class which determines the request and pass it to appropriate repository
     * 
     */

    public function __construct(UserService $data)
    {
        $this->middleware('auth');
        $this->data=$data;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * Render the index page when site loads
     */
    public function index()
    {
        return view('home');
    }

    /** 
    * fetching all user details and compact to userlist blade page
    * @return \Illuminate\Http\Response
    */
    public function userlist()
    {
        $data=$this->data->getall();
        return view('userlist',compact('data'));
    }
    /**
     * used to render the user registration page in admin dashboard
     * @return \Illuminate\Contracts\Support\Renderable 
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     *    delete specified user
     *    @return \Illuminate\Http\Response
     */
      
    public function userdelete($id)
    {
        $data=$this->data->delete($id);
        return redirect('userlist');
    }

    /**
     *     display the user edit page with prefilled data of user
     *     @return \Illuminate\Http\Response
     */
    public function useredit($id)
    {
        $data=$this->data->edit($id);
        $pieces = explode(" ", $data['name']);
        $length=sizeof($pieces);
        if($length>=2){
            $data['fname']=$pieces['0'];
            $data['lname']=$pieces['1'];
        }
        else{
            $data['fname']=$pieces['0'];
        }

        return view('auth.update',compact('data'));

    }

    /**
     *    updates the user details into the database  
     *    @param  \Illuminate\Http\Request  $request
     *    @param  \App\Models\User  $id
     */
    
    public function updateuser(Request $request,$id)
    {
        $data=$this->data->update($id,$request);
        return redirect('userlist');
 
    }

    /**
     * fetch all task data and displays in a table format
     * @return \Illuminate\Http\Response
     */
    
    public function viewtask()
    {
        $datas=$this->data->viewtask();
        return view('tasks',compact('datas'));
    }
    /**
     * displays addtask form with all usernames for task assignment
     * @return \Illuminate\Http\Response
     */
    
    public function addtask(){
        $name=$this->data->getusernames();
        return view('addtask',compact('name'));
    }

    /**
     *  takes form data from addtask and store it into the database 
     *   @param  \Illuminate\Http\Request  $request
     */
  
    public function addtasks(Request $request){
        $name=$this->data->addtasks($request);
        if($name)
        {
            session()->flash('success','Task successfully Added');
        }
        return redirect('admin/tasklist');
    }

    /**
     * displays edittask form with prefilled values also  user names for task assignment
     * @return \Illuminate\Http\Response
     * @param   \App\Models\Task  $id
     */
    
    public function edittask($id){
        $data = $this->data->edittask($id);
       $name=$this->data->getusernames();
       return view('edittask',compact('data','name'));
    }
    /** 
    *     get all data from edittask Form and pass it to services
    *     @param  \Illuminate\Http\Request  $request
    *     @param  \App\Models\Task  $id
    */
    public function edittasks(Request $request,$id){
        $name=$this->data->edittasks($request,$id);
        return redirect('admin/tasklist');

    }
    /**
     * Delets specified task 
     * @param  \App\Models\Task  $id
     * @return \Illuminate\Http\Response
     */
    public function deletetask($id){
        $result=$this->data->deletetask($id);
        if($result){
            session()->flash('success','Task successfully deleted');
        }
        return redirect('admin/tasklist');
    }

    /**
     * @return \Illuminate\Contracts\Support\Renderable
     * @return forgotpassword view
     */
    public function forgotpage(){
        return view('forgotpassword');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * takes the required credentiols and resets the password 
     */
    public function resetpassword(Request $request)
    {
         $this->data->resetpassword($request);
         return redirect('passwordrequest');
    }

    /**
     * @return \Illuminate\Http\Response
     * fetch all task according to login user
     */
    public function usertasklist(){
        $data=$this->data->usertasklist();
        return view('usertasklist',compact('data'));
    }
    /**
     *  view the detailed view specified by the user
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Task  $id
     */
    public function taskview($id){
        $data=$this->data->fetchtaskdata($id);
        return view('taskdetails',compact('data'));

    }
    /**
     * takes status of task  from FORM and updates
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $id
     */
    public function updatestatus(Request $request,$id){
        $this->data->updatestatus($request,$id);
        return redirect()->route('user/taskview', ['id' => $id]);
    }
}
