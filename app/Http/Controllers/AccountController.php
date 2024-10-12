<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobTypetime;
use App\Models\Resume;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AccountController extends Controller
{
    
   //* USER REGISTRATION
   //* This Method Will Show User Registration Page    
    public function registration(){
       return view('fronted.account.registration');
   }


   //* This Method Will Save a User
   public function RegistrationProcess(Request $request){
      $validator = Validator::make($request->all(),[
           'name' => "required",
           "email" => "required||email",
           "password" => "required||min:6||same:confirm_password",
           "confirm_password" => "required"
      ]);

      if($validator->passes()){

      $User = new User();
      
      $User->name = $request->name;
      $User->email = $request->email;
      $User->password = Hash::make($request->password);

      $User->save();
      
      session()->flash('success','You Have Registerd Successfully.');

      return response()->json([
          'status' => true,
          'errors' => []
      ]);

      }else{
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ]);
      }

      }  
    
   //*USER LOGIN 
   //* This Methos Will Show User Login Page
   public function login(){
     return view('fronted.account.login');
   }


   //* This Method Will Process To User Login 
   public function loginAuthenticate(Request $request){
      $validator = Validator::make($request->all(),[
           "email" => "required||email",
           "password" => "required||min:6"
      ]);


    if($validator->passes()){
    
      if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
          return redirect()->route('Account.Profile');
      }else{
         return redirect()->route('Account.login')
                           ->with('error','Either Email/Password IsInvalid.');
      }

    }else{
        return redirect()->route('Account.login')->withErrors($validator)->withInput($request->only('email'));
    }
      
   }

  //* This Method Will Logout User Profile
  public function logout(){
    Auth::logout();
    return redirect()->route('Account.login');
  }
  
  //* USER PROFILE 
  //* This Method Will Show User Profile Page
  public function profile(){

    $id = Auth::user()->id;
    $user = User::where('id',$id)->first();

    return view('fronted.account.profile',['user' => $user]);
  
  }


  //* This Method Will Update User Profile 
  public function UpdateProfile(Request $request){
       
     $id = Auth::user()->id;

     $validator = Validator::make($request->all(),[
         "name" => "required",
         "email" => "required||email||unique:users,email,'".$id."',id",
         "mobile" => "max_digits:10||numeric"
     ]);

     if($validator->passes()){
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->mobile = $request->mobile;
        $user->save();
        
        session()->flash('success','Profile Updated Successfully.');

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

  //* This Method Will Update User Profile Image
  public function UpdateProfileImage(Request $request){

    $id = Auth::user()->id;

    $validator = Validator::make($request->all(),[
        "image" => "required||image"
    ]);

    if($validator->passes()){

      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $imageName = $id.'-'.time().'.'.$ext;   //3-23-2022.png
      $image->move(public_path('/profile_pic/'), $imageName);

     // Create a small Thubnail
      $sourcePath = public_path('/profile_pic/'.$imageName);
      $manager = new ImageManager(Driver::class);
      $image = $manager->read($sourcePath);

      // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
      $image->cover(150, 150);
      $image->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

      //* Delete Old Profile Image 
      File::delete(public_path('/profile_pic/thumb/').Auth::user()->image);
      File::delete(public_path('/profile_pic/').Auth::user()->image);

      User::where('id',$id)->update([ 'image' => $imageName ]);
 
      session()->flash('success',"Profile Picture updated Successfully");
 
      return response()->json([
          'status' => true,
          "errors" => []
      ]);

    }else{

      return response()->json([
          'status' => false,
          'errors' => $validator->errors()
      ]);
    }
  }

  //* UPDATE PASSWORD
  //* This Method Will Show Update Password Page
     public function ShowUpdatePasswordForm(){

       return view('fronted.account.change_Password');
     }

  //* This Method Will Change Password
   public function UpdatePasswordProcess(Request $request){

    $validator = Validator::make($request->all(),[
       'old_password' => "required:||min:6",
       'new_password' => "required||min:6",
       'confirm_password' => "required||min:6||same:new_password"
    ]);

     if($validator->fails()){
       return response()->json([
          'status' => false,
          'errors' => $validator->errors()
        ]);
      }

      if(Hash::check($request->old_password, Auth::user()->password) == false){
         session()->flash('error','Your old password is incorrect.');         
         return response()->json([
           'status' => true,
           'errors' => 'justuseRelodePage'
         ]);
      }

      $user = User::find(Auth::user()->id);
      $user->password = Hash::make($request->new_password);
      $user->save();

      session()->flash('success','Password updated Successfully.');
      return response()->json([
         'status' => true
      ]);
    }

  //* CREATE NEW JOB 
  //* This Method Will Show Job Create Form 
  public function CreateJob(){
 
    $jobCategory = JobCategory::where('status',1)->orderBy('jobName','ASC')->get();

    $jobTypeTime = JobTypetime::where('status',1)->orderBy('timeTypeName','Asc')->get();

    return view('fronted.account.jobs.CreateJob',
                [ 'jobCategory' => $jobCategory ],
                [ 'jobTypeTime' => $jobTypeTime ]
              );
  }

  //* This Method Will Save Job In Database
  public function SaveJob(Request $request){
    $validator = Validator::make($request->all(),[
        'title' => "required||max:200",
        'job_category' => "required",
        'job_timeType' => "required",
        'vacancy' => "required",
        'location' => "required||max:50",
        'description' => "required",
        'company_logo' => 'required|image',
        'company_name' => "required"
    ]);

    if($validator->passes()){
      
      if($request->hasFile('company_logo')){
         $company_logo = $request->file('company_logo');
         $fileName = time().'-'.$company_logo->getClientOriginalName();
         $company_logo->move(public_path('assets/company_logo/'),$fileName);

      job::create([
          "title" => $request->title,
          'job_category_id' => $request->job_category,
          'job_typeTime_id' => $request->job_timeType,
          'user_id' => Auth::user()->id,
          'vacancy' => $request->vacancy,
          'salary' => $request->salary,
          'location' => $request->location,
          'description' => $request->description,
          'benefits' => $request->benefits,
          'responsibility' => $request->responsibility,
          'qualifications' => $request->qualifications,
          'Keywords' => $request->keywords,
          'experience' => $request->experience,
          'company_logo' => $fileName,
          'companyName' => $request->company_name,
          'companyLocation' => $request->Company_location,
          'companyWebsite' => $request->website
      ]);
     
       session()->flash('success','Job Added SuccessFully.');

       return response()->json([
          'status' => true,
          'errors' => []
       ]);

      }else{
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


  //*  This Method Will Show My Jobs Page
  public function My_Jobs(){
     $jobs = job::where('user_id',Auth::user()->id)
                       ->with(['JobTypetime','JobTypetime'])
                       ->paginate(5);

     return view('fronted.account.jobs.myJobs',[ "jobs" => $jobs]);
  }

  //* This Method Is Edit Jobs
  public function editJobs(Request $request , $id){
    $jobCategory = JobCategory::where('status',1)->orderBy('jobName')->get();
    $jobTypeTime = JobTypetime::where('status',1)->orderBy('timeTypeName')->get();
    $job = job::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

    if($job == null){
      abort(404);
    }

    return view('fronted.account.jobs.editJob',[ 
                                "jobCategory" => $jobCategory,
                                "jobTypeTime" => $jobTypeTime,
                                "job" => $job
                               ]);
  } 
    
  //* This Method Will Edit Job Data
    public function UpdateJobProcess(Request $request, $id){
      $validator = Validator::make($request->all(),[
          'title' => "required|max:200",
          'job_category' => "required",
          'job_timeType' => "required",
          'vacancy' => "required",
          'location' => "required|max:50",
          'description' => "required",
          'company_name' => "required",
          'company_logo' => "required|image"
      ]);
  
      if($validator->passes()){

        //* Company logo Image Update
        if($request->hasFile('company_logo')){
           $company_logo = $request->file('company_logo');
           $fileName = time().'-'.$company_logo->getClientOriginalName();
           $company_logo->move(public_path('assets/company_logo/'),$fileName); 

           job::find($id)->update([
            "title" => $request->title,
            'job_category_id' => $request->job_category,
            'job_typeTime_id' => $request->job_timeType,
            'user_id' => Auth::user()->id,
            'vacancy' => $request->vacancy,
            'salary' => $request->salary,
            'location' => $request->location,
            'description' => $request->description,
            'benefits' => $request->benefits,
            'responsibility' => $request->responsibility,
            'qualifications' => $request->qualifications,
            'Keywords' => $request->keywords,
            'experience' => $request->experience,
            'company_logo' => $fileName,
            'companyName' => $request->company_name,
            'companyLocation' => $request->Company_location,
            'companyWebsite' => $request->website
        ]);
  
         session()->flash('success','Job Updated SuccessFully.');
  
         return response()->json([
            'status' => true,
            'errors' => []
         ]);

        }else{
           return response()->json([
              'status' => false,
              'message' => "Image Not Found"
           ]);
        }
        
        }else{
          return response()->json([
            'status' => false,
            'errors' => $validator->errors()
          ]);
      }
    } 

  //* This Method Will Delete User Job
  public function deleteJob(Request $request){
     $deleteJob = job::where([
                     'user_id' => Auth::user()->id,
                     'id' => $request->jobId
                  ])->first();
     
     if($deleteJob == null){
       session()->flash('error',"Either Job Deleted or Not Found.");
       return response()->json([
       "status" => true
     ]);
    }

   job::where('id',$request->jobId)->delete();
    session()->flash('success',"job Deleted Successfully");
      return response()->json([
      "status" => true
    ]);
  } 

  //* APPLIED JOB
  //*  This Method Will Show Applied Job
    public function myAppliedJob(){

      $JobApplications = JobApplication::where('user_id',Auth::user()->id)
                    ->with('job','job.JobTypetime','job.Application')
                    ->paginate(6);

      return view('fronted.account.jobs.My-JobApplication',['JobApplications' => $JobApplications]);
    
    }

  //* This Method Will Delete Applied Job
    public function removeAppliedJob(Request $request){

      $removeJob = JobApplication::where(['id' => $request->id,'user_id' => Auth::user()->id])->first();
      
      if($removeJob == null){
        session()->flash('error','Job Application Not Found');
        return response()->json([
          'status' => false
        ]);
      }

      JobApplication::find($request->id)->delete();
      
      session()->flash('success','Job Application Removed Successfully');
      return response()->json([
        'status' => true,
      ]);
    }

  //* SAVED JOB 
  //* This Method Will Show Saved Jobs Page
    public function SavedJobsShow(){

      $savedJobs = SavedJob::where(['user_id' => Auth::user()->id])
                ->with(['job','job.JobTypetime','job.Application'])
                ->paginate(6);

      return view('fronted.account.jobs.SavedJobes',[ "savedJobs" => $savedJobs]);
    } 

  //* This Method Will Remove Saved Jobs
    public function RemoveSavedJob(Request $request){
      $id = $request->id;
      $user_id = Auth::user()->id;
      $removeJob = SavedJob::where(['user_id' => $user_id , 'id' => $id])->first();

      if($removeJob == null){
        session()->flash('error','Job Not Found');
        return response()->json([
          'status' => false
        ]);
      }

      SavedJob::find($id)->delete();
    
      session()->flash('success', "Job Removed Successfully");
      return response()->json([
         'status' => true
      ]);
    }

    //* FORGOT PASSWORD
    //* This Method Will Show Forgot Password Form
    public function ForgotPassword(){
      return view('fronted.account.forgot_password');
    }  

    //* This Method Will Process Forgot Password
    public function ProcessForgotPassword(Request $request){
      $validator = Validator::make($request->all(),[
         "email" => "required||email||exists:users,email"
      ]);

      if($validator->fails()){
        return redirect()->route('account.ForgotPassword')->withInput()->withErrors($validator);
      }

      $token = Str::random(60);

      DB::table('password_reset_tokens')->where('email',$request->email)->delete();
      DB::table('password_reset_tokens')->insert([
         "email" => $request->email,
         "token" => $token,
         "created_at" => now()
      ]);

      //* Send Email Here
      $user = User::where('email', $request->email)->first();
      $mailData = [
         'token' => $token,
         'user' => $user,
         'subject' => 'You Have requested to Change Your Password.'
      ];

      Mail::to($request->email)->send( new ResetPasswordEmail($mailData));
     
      return redirect()->route('account.ForgotPassword')->with('success','Reset Password has been sent to your inbox.');
    }  

    //* This Method Will Check Token is Valid/Incvalid  
    public function ResetPassword($tokenString){
      $token = DB::table('password_reset_tokens')->where('token',$tokenString)->first();

       if($token == null){
         return redirect()->route('account.ForgotPassword')->with('error','Invalid Token');
       }

       return view('fronted.account.reset_password',['tokenString' => $tokenString]);
    }

    //* RESET PASSWORD
    //* This method will Reset Password
    public function ResetPasswordProcess(Request $request){
       $token = DB::table('Password_reset_tokens')->where('token',$request->token)->first();

       if($token == null){
          return redirect()->route('account.ForgotPassword')->with('error','Invalid Token.');
       }

       $validator = Validator::make($request->all(),[
          "new_password" => "required||min:6",
          "confirm_password" => "required||same:new_password",
       ]);

       if($validator->fails()){
          return redirect()->route('Reset.Password',$request->token)->withErrors($validator); 
       }

       User::where('email',$token->email)->update([
          "password" => Hash::make($request->new_password)
       ]);

       return redirect()->route('Account.login')->with('success','You have successfully changed your password');
    }


    //* UPLOAD CV/RESUME 
    //* This Method Will Show Resume Upload Page
    public function ShowResume(){

      $uploadedCv = Resume::where('user_id',Auth::user()->id)->get();
      return view('fronted.account.jobs.resumeUpload',compact('uploadedCv'));
    } 

    public function UploadResume(Request $request){
        $validator = Validator::make($request->all(),[
            "resumeImg" => "required|mimes:png,jpg,webp,pdf,jpeg|max:20480"
        ]);

        if($validator->passes()){
          if($request->hasFile('resumeImg')){
            $file = $request->file('resumeImg');
            $fileName = time().'-'.$file->getClientOriginalName();
            $file = $file->move(public_path('assets/Resume-image/'),$fileName);


            Resume::create([
              "resumeImg" => $fileName,
              "user_id" => Auth::user()->id
            ]);

            session()->flash('success','Resume Uploaded Successfull.');
            return response()->json([
               'status' => true
            ]);
          }

        }else{
          return response()->json([
             'status' => false,
             'errors' => $validator->errors()
          ]);
        }
    }

    //* This Method Will Delete Uploaded Resume
    public function DeleteUploadedResume(Request $request){
       $resumeId = Resume::find($request->id);
       
       File::delete(public_path('assets/Resume-image/').$resumeId->resumeImg);
       $resumeId->delete();
      
       session()->flash('success','CV successfully deleted.');

       return response()->json([
         'status' => true
       ]);
    }  

    //* This Method Will show Resume Deatail 
    public function ResumeDeatail(string $id){
      $resumeDeatail = Resume::findOrFail($id);

        return view('fronted.account.jobs.resumeDeatail',compact('resumeDeatail'));
    }
  }
