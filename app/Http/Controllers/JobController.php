<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobTypetime;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    //* This Method Will Show Job

    public function findJobShow(Request $request){

       $jobCategory = JobCategory::where('status',1)->orderBy('jobName','asc')->get();
       $jobTypeTime = JobTypetime::where('status',1)->orderBy('timeTypeName')->get();

       $job = job::where('status',1);

    //* Search Using Keyword
      if(!empty($request->keywords)){
         $job = $job->where(function($query) use($request) {
           $query->orWhere('title','like','%'.$request->keywords.'%');
           $query->orWhere('description','like','%'.$request->keywords.'%');
           $query->orWhere('keywords','like','%'.$request->keywords.'%');
         });
      }   

    //* Search Using Location 
       if(!empty($request->location)){
          $job = $job->where('location',$request->location);
       }

    //* Search Using Job Category
       if(!empty($request->Jobcategory)){
           $job = $job->where('job_category_id',$request->Jobcategory);
       }

    //* Search Using Job Timing
      $jobTimingArray = [];
      if(!empty($request->job_Typetime)){
         $jobTimingArray = explode(',',$request->job_Typetime);
         
         $job = $job->whereIn('job_typeTime_id',$jobTimingArray);
      }

    //* Search Using Job Experience
      if(!empty($request->experience)){
         $job = $job->where('experience',$request->experience);
      }

    //* Serach Latest And Oldest 
      if($request->sort == 0){
         $job = $job->orderBy('created_at','ASC');
      }else{
         $job = $job->orderBy('created_at','DESC');
      }
    

    
      $job = $job->with(['JobCategory'])->paginate(5);

        return view('fronted.findJobs',[
                      "jobCategory" => $jobCategory,
                      "jobTypeTime" => $jobTypeTime,
                      "jobs" => $job,
                      "jobTimingArray" => $jobTimingArray
        ]);
    }

   //* This Method Will Show Job Deatail Page  
      public function jobDeatail($id){
        $jobDeatail = job::where(['id' => $id, 'status' => 1 ])->with('JobTypetime')->first();

        if($jobDeatail == ""){
           abort(404);
        }

      //* Applicant 
      $Applicants = JobApplication::where('job_id',$id)->with('user')->paginate(1);

         return view('fronted.jobDeatail', compact(['jobDeatail','Applicants']));
      } 

     //todo This Method Will Apply Job
      public function applyJob(Request $request){
         $id = $request->id;

         $jobApply = job::where('id',$id)->first();
         
         //* If job not found in db
         if($jobApply == null){
            $message = "Job Does Not Exist.";
            session()->flash('error',$message);
            return response()->json([
               'status' => false,
            ]);
         }

         //* You can Not apply on your Own job
         $employer_id = $jobApply->user_id;
         if($employer_id == Auth::user()->id){
            $message = "You can Not apply on your Own job";
            session()->flash('error',$message);
             return response()->json([
               'status' => false,
             ]);
         }

         //* You Can not Apply on a job twise  
         $JobApplicationCount = JobApplication::where([ 'user_id' => Auth::user()->id, 'job_id' => $id ])->count();
          if($JobApplicationCount > 0){
            $message = "You Already Applied on this Job";
            session()->flash('error',$message);
            return response()->json([
               'status' => false,
            ]);
          }

         $employer = new JobApplication();

         $employer->job_id = $id;
         $employer->user_id = Auth::user()->id;
         $employer->employer_id = $employer_id;
         $employer->applied_date = now();
         $employer->save();

         $message = "You Have Successfully Applied";
         session()->flash('success',$message);
         return response()->json([
            'status' => true,
         ]);
      } 

      
     //todo This Method Will Save Job
      public function savedJob(Request $request){
         $id = $request->id;
         $user_id = Auth::user()->id;

         $savedJob = job::where('id',$id)->first();

         //* if Job does Not Exist
         if($savedJob == null){
            $message = "Job does Not Exist";
            session()->flash('error',$message);
            return response()->json([
               'status' => false,
            ]);
         }

         //* Check if User Already Saved the Job
         $savedJobCount = SavedJob::where(['user_id' => $user_id, 'id' => $id])->count();
         
         if($savedJobCount > 0){
            $message = "You Already Saved on this Job";
            session()->flash('error',$message);
            return response()->json([
               'status' => false,
            ]);
         }

         $savedJob = new SavedJob();
         $savedJob->job_id = $id;
         $savedJob->user_id = $user_id;
         $savedJob->save();
         
         $message = "You Have Successfully Saved The Job";
         session()->flash('success',$message);
         response()->json([
            'status' => true,
         ]);
      }
}
