<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\job;
use App\Models\JobCategory;
use App\Models\JobTypetime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminJobController extends Controller
{

   //* This Method Will Show Admin Job
   public function index(){

    $jobs = job::orderBy('created_at','DESC')->with(['User','JobTypetime','JobCategory'])->paginate(7); 

      return view('admin.users.adminJobList', compact('jobs'));
   } 

   //* This Method Will Show Job Edit Form
   public function EditAdminJob($id){
      
      $jobCategory = JobCategory::orderBy('jobName')->get();
      $jobTypeTime = JobTypetime::orderBy('timeTypeName')->get();
      $editJob = job::findOrFail($id);

      return view('admin.users.Edit_AdminJob', compact(['editJob', 'jobCategory','jobTypeTime']));
   }

   //* This Method Will Update Admin Job
   public function UpdateAdminJob(Request $request, $id){
      $validator = Validator::make($request->all(),[
          'title' => "required||max:200",
          'job_category' => "required",
          'job_timeType' => "required",
          'vacancy' => "required",
          'location' => "required||max:50",
          'description' => "required",
          'company_name' => "required",
          'company_logo' => "required|image|mimes:jpg,jpeg,png,webp"
      ]);

      if($validator->passes()){
      
      // image Update
      if($request->hasFile('company_logo')){
         $file = $request->file('company_logo');
         $fileName = time().'-'.$file->getClientOriginalName();
         $file->move(public_path('assets/company_logo/'),$fileName);

       // Delete The Exit file   
         $file_path = public_path('assets/company_logo/') . job::find($id)->Company_logo;
         if(file_exists($file_path)){
            @unlink($file_path);
         }

      job::find($id)->update([
         "title" => $request->title,
         "job_Category_id" => $request->job_category,
         "job_typetime_id" => $request->job_timeType,
         "vacancy" => $request->vacancy,
         "salary" => $request->salary,
         "location" => $request->location,
         "description" => $request->description,
         "benefits" => $request->benefits,
         "responsibility" => $request->responsibility,
         "qualifications" => $request->qualifications,
         "keywords" => $request->keywords,
         "experience" => $request->experience,
         "Company_logo" => $fileName,
         "companyName" => $request->company_name,
         "companyLocation" => $request->Company_location,  
         "companyWebsite" => $request->website
      ]);

         session()->flash('success','Job Updated Successfully.');
         return response()->json([
            "status" => true,
         ]);

      }

      }else{
         return response()->json([
            'status' => false,
            'errors' => $validator->errors()
         ]);
      }
   } 

   //* This Function Will Remove Admin Job
   public function RemoveAdminJob(Request $request){
      $id = $request->id;
      $removeJob = job::find($id);

      if($removeJob == null){
         session()->flash('error',"Either Job Deleted or Not Found.");
         return response()->json([
         "status" => false
       ]);
      }

      $removeJob->delete();

      session()->flash('success','Job Removed Successfully.');
      return response()->json([
         'status' => true
      ]);
   } 

   //* Active And Deactive 
   public function ActiveJob($id){
     
      $jobid = job::find($id); 
   
      if($jobid->status){
         $jobid->status = 0;
      }else{
         $jobid->status = 1;
      }

      $jobid->save();
      return back();
   
   }
}
