<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class JobCategoryController extends Controller
{
    
    //* This Method Will Show Category
    public function jobCategoryShow(){

      $Categories = JobCategory::paginate(5);
       return view('admin.job.job_category', compact('Categories'));
    }

    //* This Method Will Store/Create Category
    public function CreateJobCategory(Request $request){
       $validator = Validator::make($request->all(),[
          "jobName" => "required",
          "image" => "required||image||mimes:png,jpg,webp,jpeg", 
       ]);

       if($validator->passes()){
        
        if($request->hasFile('image')){
           $image = $request->file('image');
           $fileName = time().'-'.$image->getClientOriginalName();
           $image->move(public_path('/assets/admin-panel/admin_images/'),$fileName);
   
         JobCategory::create([
            "jobName" => $request->jobName,
            "image" => $fileName
         ]);

         session()->flash('success','Job category created successfully');
         return response()->json([
            'status' => true,
            'errors' => []
         ]);

        }else{
            return response()->json([
              "status" => false,
              "message" => "image Not Found"
            ]);
        }

       }else{
          return response()->json([
             "status" => false,
             "errors" => $validator->errors()
          ]);
       }
    }

   //* This Method Will Show The Edit Form
   public function EditJobCategory($id){
      $category = JobCategory::findOrFail($id);

      return view('admin.job.update_jobCategory', compact('category'));
   }

   //* This Method Will Update Job Category
   public function UpdateJobCategory(Request $request, $id){
     $validator = Validator::make($request->all(),[
        "jobName" => "required",
        "image" => "required||mimes:png,jpg,jpeg,webp",
     ]);

     if($validator->passes()){
       if($request->hasFile('image')){
         $image = $request->file('image');
         $fileName = time().'-'.$image->getClientOriginalName();
         $image->move(public_path('assets/admin-panel/admin_images/'),$fileName);

         JobCategory::find($id)->update([
            'jobName' => $request->jobName,
            'image' => $fileName
         ]);

         session()->flash('success','Job Category Updated SuccessFully.');
         return response()->json([
            'status' => true,
            'errors' => []
         ]);

       }else{
         session()->flash('error','Image Not Found.');
         return response()->json([
            'status' => false
         ]);
       }

     }else{
       return response()->json([
          'status' => false,
          'errors' => $validator->errors()
       ]);
     }
   }  
   
   //* This Method Will Delete Job Category
   public function DeleteJobCategory(Request $request){
      $id = $request->id;
      $Category = JobCategory::findOrFail($id);

      
      $image_path = public_path('assets/admin-panel/admin_images/'.$Category->image);
      
      if(file_exists($image_path)){
         @unlink($image_path);
      }else{
         return response()->json([
            'status' => false
         ]);
      }

      $Category->delete();
      
      session()->flash('success','Job Category Deleted Successfully.');
   
   }

   //* Active And Deactive Job Category Status
   public function ActiveJobCategory($id){
      $jobCategory = JobCategory::find($id);

      if($jobCategory->status){
         $jobCategory->status = 0;
      }else{
         $jobCategory->status = 1;;
      }

      $jobCategory->save();
      return back();
   }

}
