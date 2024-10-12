<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AccountController;
 use App\Http\Controllers\admin\AdminJobController;
use App\Http\Controllers\admin\AdminContactController;
use App\Http\Controllers\HomeController;
 use App\Http\Controllers\JobController;
 use App\Http\Controllers\admin\DashboardController;
 use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobCategoryController;
use App\Http\Controllers\admin\JobTypetimeController;
use App\Http\Controllers\admin\TeamMemberController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
 
 
   Route::get('/',[HomeController::class,'home'])->name('Home');
   
   Route::get('/job/findjob',[JobController::class,'findJobShow'])->name('Show.findJob');
   Route::get('/job/Deatail/{jobid}',[JobController::class,'jobDeatail'])->name('Show.jobDeatail');
   Route::get('/job/Applicant/{id}',[JobController::class,'ApplicantListShow'])->name('ApplicantShow');
   Route::post('/apply-apply',[JobController::class,'applyJob'])->name('applyJob');
   Route::post('/savedJob',[JobController::class,'savedJob'])->name('savedJob');
   Route::get('/Contact',[ContactController::class,'ContactIndex'])->name('Contact');
   Route::post('/create/contact',[ContactController::class,'CreateContact'])->name('create.Contact');
   Route::get('/About_us',[AboutUsController::class,'AboutUs'])->name('AboutUs');
   
   Route::get('forgotPassword',[AccountController::class,'ForgotPassword'])->name('account.ForgotPassword');
   Route::post('Process_forgotPassword',[AccountController::class,'ProcessForgotPassword'])->name('account.ProcessForgotPassword');
   Route::get('ResetPassword/{token}',[AccountController::class,'ResetPassword'])->name('Reset.Password');
   Route::post('ResetPasswordProcess',[AccountController::class,'ResetPasswordProcess'])->name('Process.ResetPassword');

  //* DashboardController Route  
   Route::group(['prefix' => 'admin', 'middleware' => 'CheckRole'], function(){
       Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
       Route::get('/Dashbords',[DashboardController::class,'dashboard_Content'])->name('dashboard_content');
       Route::get('/UserList',[UserController::class,'UserList'])->name('userList');
       Route::get('/EditUser/{id}',[UserController::class,'EditUser'])->name('Edit.User');
       Route::put('/UpdateUser/{id}',[UserController::class,'UpdateUser'])->name('Update.User');
       Route::post('/RemoveUser',[UserController::class,'RemoveUser'])->name('Remove.User');
       Route::get('/ShowAdminJob',[AdminJobController::class,'index'])->name('Show.AdminJob');
       Route::get('/EditJob/{id}',[AdminJobController::class,'EditAdminJob'])->name('Edit.AdminJob');
       Route::put('/UpdatAdminJob/{id}',[AdminJobController::class,'UpdateAdminJob'])->name('Update.Adminjob');
       Route::post('/RemoveAdminJob',[AdminJobController::class,'RemoveAdminJob'])->name('Remove.AdminJob');
       Route::get('/admin.ActiveJob/{id}',[AdminJobController::class,'ActiveJob'])->name('admin.ActiveJob');
       Route::get('/JobApplication',[JobApplicationController::class,'JobApplicationShow'])->name('admin.JobApplication');
       Route::post('/RemoveJobApplication',[JobApplicationController::class,'RemoveJobApplication'])->name('Remove.JobApplication');
       Route::get('/jobCategoryShow',[JobCategoryController::class,'jobCategoryShow'])->name('show.JobCategory');
       Route::post('/CreateJobCategory',[JobCategoryController::class,'CreateJobCategory'])->name('Create.JobCategory');
       Route::get('/EditJobCategory/{id}',[JobCategoryController::class,'EditJobCategory'])->name('Edit.JobCategory');
       Route::post('/UpdateJobCategory/{id}',[JobCategoryController::class,'UpdateJobCategory'])->name('Update.JobCategory');
       Route::post('/DeleteJobCategory',[JobCategoryController::class,'DeleteJobCategory'])->name('Delete.JobCategory');
       Route::get('/ActiveJobCategory/{id}',[JobCategoryController::class,'ActiveJobCategory'])->name('ActiveJobCategory');
       Route::get('/JobTypeTime',[JobTypetimeController::class,'JobTypeTime'])->name('display.JobTypeTime');
       Route::post('/CreateJobTypetime',[JobTypetimeController::class,'CreateJobTypetime'])->name('Create.JobTypetime');
       Route::get('/EditJobTypetime/{id}',[JobTypetimeController::class,'EditJobTypetime'])->name('Edit.JobTypetime');
       Route::put('/UpdateJobTypeTime/{id}',[JobTypetimeController::class,'UpdateJobTypeTime'])->name('Update.JobTypeTime');
       Route::post('/RemoveJobTypeTime',[JobTypetimeController::class,'RemoveJobTypeTime'])->name('Remove.JobTypeTime');
       Route::get('/ActiveJobTypeTime/{id}',[JobTypetimeController::class,'ActiveJobTypeTime'])->name('ActiveJobTypeTime');
       Route::get('/contactList',[AdminContactController::class,'ContactShow'])->name('Show.Contact');
       Route::post('/RemoveContact',[AdminContactController::class,'RemoveContact'])->name('Remove.Contact');
       Route::get('/teamMember.show',[TeamMemberController::class,'TeamMemberShow'])->name('teamMember.show');
       Route::post('/Add.teamMember',[TeamMemberController::class,'AddTeamMember'])->name('Add.TeamMember');
       Route::post('/delete.TeamMember',[TeamMemberController::class,'DeleteTeamMember'])->name('delete.TeamMember');
       Route::get('/Edit.TeamMember/{id}',[TeamMemberController::class,'EditTeamMember'])->name('edit.teamMember');
       Route::put('Update.TeamMember/{id}',[TeamMemberController::class,'UpdateTeamMember'])->name('Update.TeamMember');
   });

  //* AccountController Route
   Route::group(['prefix' => 'Account'], function(){  
     // Guest Route
      Route::group(['middleware' => 'guest'], function(){
         Route::get('Register',[AccountController::class,'registration'])->name('Account.register'); 
         Route::post('.processAccount',[AccountController::class,'RegistrationProcess'])->name('Register.process');
         Route::get('login',[AccountController::class,'login'])->name('Account.login');    
         Route::post('loginAuthenticate',[AccountController::class,'loginAuthenticate'])->name('login.Authenticate');
      });

     //Authenticate Middleware
      Route::group(['middleware' => 'auth'], function(){
         Route::get('/profile',[AccountController::class,'profile'])->name('Account.Profile');
         Route::put('/UpdateProfile',[AccountController::class,'UpdateProfile'])->name('Account.UpdateProfile');
         Route::put('/UpdateProfileImg',[AccountController::class,'UpdateProfileImage'])->name('Account.UpdateProfileImage');
         Route::get('/UpdatePassword',[AccountController::class,'ShowUpdatePasswordForm'])->name('Update.password');
         Route::post('/UpdatePasswordProcess',[AccountController::class,'UpdatePasswordProcess'])->name('Process.Updatepassword');
         Route::get('/logout',[AccountController::class,'logout'])->name('Account.logout');
         Route::get('/Job',[AccountController::class,'CreateJob'])->name('Accont.job');
         Route::post('/SaveJob',[AccountController::class,'SaveJob'])->name('Account.SaveJob');
         Route::get('/MyJobs',[AccountController::class,'My_Jobs'])->name('Account.MyJobs');
         Route::get('/editJob/{id}',[AccountController::class,'editJobs'])->name('Account.editJob');
         Route::put('/updateJob/{id}',[AccountController::class,'UpdateJobProcess'])->name('Account.updateJob');
         Route::post('/deletejob',[AccountController::class,'DeleteJob'])->name('Account.delete');
         Route::get('/myAppliedJob',[AccountController::class,'myAppliedJob'])->name('myJob.Applied');
         Route::post('/RemoveAppliedJob',[AccountController::class,'removeAppliedJob'])->name('Remove.AppliedJob');
         Route::get('/SavedJoblist',[AccountController::class,'SavedJobsShow'])->name('Show.savedJob');
         Route::post('/removeSavedJob',[AccountController::class,'RemoveSavedJob'])->name('remove.SavedJob');
         Route::get('/showResume',[AccountController::class,'ShowResume'])->name('show.Resume');
         Route::post('/ResumeUpload',[AccountController::class,'UploadResume'])->name('UploadResume');
         Route::post('/DeleteUploadedResume',[AccountController::class,'DeleteUploadedResume'])->name('Delete.UploadedResume');
         Route::get('/ResumeDeatail/{id}',[AccountController::class,'ResumeDeatail'])->name('ResumeDeatail');
      });
   });
   