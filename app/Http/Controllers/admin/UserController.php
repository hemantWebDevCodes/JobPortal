<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

  //* This Method Will Show User List
   public function UserList(){    
    $users = User::orderBy('created_at','DESC')->paginate(8);

    return view('admin.users.user-list', compact('users'));
   }

  //* This Method Will Show Edit Form
   public function EditUser($id){ 
     $UserEdit = User::find($id);
      return view('admin.users.updateUser', compact('UserEdit'));
   }

  //* This Method Will Update User 
   public function UpdateUser(Request $request, $id){
      $validator = Validator::make($request->all(),[
         'name' => 'required',
         'email' => 'required||email||unique:users,email,"'.$id.'",id',
         'mobile' => 'required||numeric||max_digits:10'
      ]);

      if($validator->passes()){
        
        $UpdateUser = User::find($id);
        
        $UpdateUser->name = $request->name;
        $UpdateUser->email = $request->email;
        $UpdateUser->mobile = $request->mobile;
        $UpdateUser->save();

       session()->flash('success','User Updated Successfully');

       return response()->json([
        'status' => true,
        'errors' => []
       ]);

      }else{
        return response()->json([
           'status' => false,
           'errors' => $validator->errors()
        ]);
      }
   }

  //* This Method Will Remove User   
   public function RemoveUser(Request $request){
      
    $id = $request->id;
    $removeUser = User::find($id);
    
    if($removeUser == null){
       session()->flash('error','User Not Found');
       return response()->json([
         'status' => false,
       ]);  
    }
    
    $removeUser->delete();

    session()->flash('success','User Deleted Successfully.');
    return response()->json([
      'status' => false
    ]);
    
  }
}
