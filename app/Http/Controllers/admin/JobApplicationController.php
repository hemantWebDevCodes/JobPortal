<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
   //* This Method Will Show Admin Job Application 
   public function JobApplicationShow(){
    $JobApplications = JobApplication::orderBy('created_at','DESC')->with(['job','user','employer'])->paginate(10);

     return view('admin.users.JobApplication', compact('JobApplications'));    
   }

   //* This Method Will Delete Admin Application Job
   public function RemoveJobApplication(Request $request){
     $id = $request->id;

     $removeApplication = JobApplication::find($id);  

     if($removeApplication == null){
        session()->flash('error','Either Job Deleted or Not Found.');
        return response()->json([
           'status' => false
        ]);

     $removeApplication->delete();
     
     return $removeApplication;
     session()->flash('success','Job Application Deleted Successfully.');
     return response()->json([
        'status' => true
     ]);
     }
   }   
}
