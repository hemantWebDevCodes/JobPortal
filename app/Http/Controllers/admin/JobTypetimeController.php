<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobTypetime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobTypetimeController extends Controller
{
    //* This Method Will Show Job Typetime Page 
    public function JobTypeTime(){
       
       $jobTypeTimes = JobTypetime::get();

       return view('admin.job.jobTypetime', compact('jobTypeTimes'));
    }

    //* This Method Will Create Job Timing
    public function CreateJobTypetime(Request $request){
       $validator = Validator::make($request->all(),[
          "timeTypeName" => "required||unique:job_typetimes,timeTypeName,'.$request->timeTypeName.',id"
       ]);

       if($validator->passes()){
          $jobtime = new JobTypetime();

          $jobtime->timeTypeName = $request->timeTypeName;
          $jobtime->save();
          
          session()->flash('success','Job Type Added Successfully.');
          return response()->json([
             'status' => true,
             'errors' => []
          ]);

       }else{
         return response()->json([
          "status" => false,
          "errors" => $validator->errors()
         ]);
       }
    }

    //* This Method Will Get Single Data For Update job Timing 
    public function EditJobTypetime($id){
        $jobtime = JobTypetime::findOrFail($id);

        return view('admin.job.update_jobTypetime', compact('jobtime'));
    }

    //* This Method Will Update Job Timing
    public function UpdateJobTypeTime(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "timeTypeName" => "required"
        ]);

        if($validator->passes()){
            $update = JobTypetime::find($id);
            $update->timeTypeName = $request->timeTypeName;
            $update->save();
            
            session()->flash('success','Job Timing Updated Successfully');
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

   //* This Method Will Delete Job Type time
   public function RemoveJobTypeTime(Request $request){
     $id = $request->id;
     $jobTypeRemove =  JobTypetime::findOrFail($id);
     
     if($jobTypeRemove == null){
       session()->flash('error','Delete Not Found.');
       return response()->json([
         'status' => false,
       ]);
     }

     $jobTypeRemove->delete();
     session()->flash('success','Job Timing Deleted Successfully.'); 
   }  

   //* Active And Deactive 
   public function ActiveJobTypeTime($id){
   
      $jobTimeid = JobTypetime::find($id); 
   
      if($jobTimeid->status){
         $jobTimeid->status = 0;
      }else{
         $jobTimeid->status = 1;
      }

      $jobTimeid->save();
      return back();
   
   }

}
