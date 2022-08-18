<?php
 namespace App\Repository;
 use App\Models\User;
 Use DB;

 class UserRepository{

 protected $users;

  public function __construct(User $users){

    $this->Userobject=$users;
  }

  /**
   * get details of all users
   * @return \Illuminate\Http\Response
   */
  public function getallusers(){
   return $this->Userobject->where('role','!=',0)->paginate(4);

  }
  
  /**
   * delete a specified user 
   * @return \Illuminate\Http\Response
   */
  public function delete($id){
    return $this->Userobject->destroy($id);
   }
   
  /**
   * returns details of a specified user
   * @return \Illuminate\Http\Response
   * @param Model\User $id
   */
   public function edit($id){
   return $data= $this->Userobject->find($id);
   }

  /**
   *  @param  \Illuminate\Http\Request  $request
   *  updates details of a specified user
   *  @param Model\User $id
   */
   public function update($id, $data){
      $validator=$data->validate([
            'fname' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,name,',
            'lname' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,name,',
            'email' => ['required', 'string', 'email', 'max:255', ],
            'phno'=> ['required', 'string', 'max:10','min:10'],
        ]);
        if($validator){
       $data['name'] = $data['fname'] ." ". $data['lname'];
       $update = $this->Userobject->find($id);   
       $update['name'] = $data['name'];
       $update['email'] = $data['email'];
       $update['phnumber'] = $data['phno'];
       $update->update();
       $result= $update->fresh();
       if($result)
        {
            session()->flash('success','User successfully updated');
            return $result;
        }
        }
      }
      
  /**
   * Gets names of all users for task assignment
   * @return \Illuminate\Http\Response
   */
      public function getusernames(){
        $data = $this->Userobject->select('name','id')->where('role','=',1)->get();
      return $data;
      }
      
  /**
   * @param  \Illuminate\Http\Request  $request
   * updates password of a specified user
   */
      public function resetpassword($request){
        $validator=$request->validate([
          'oldpassword'=>['required'],
          'newpassword' => ['required', 'string', 'min:8'],
          'confirmpassword' => ['required', 'string', 'min:8'],

        ]);

       if($validator){
        $oldpassword=$request->oldpassword;
        $dboldpassword=\Auth::user()->password;
        if($request->newpassword==$request->confirmpassword){
        if(password_verify($oldpassword, $dboldpassword)) {
          $update= $this->Userobject->find(\Auth::id());
          $update['password']=\Hash::make($request->newpassword);
          $update->update();
          $result= $update->fresh();
          if($result)
          {
            session()->flash('success','password successfully updated');
          }
        }
      else{
        session()->flash('fail','old password is wrong ');
      }}
      else{
        session()->flash('fail','password confirm password did not match');
      }

      return true;
    }
  }
    }
  
 


?>