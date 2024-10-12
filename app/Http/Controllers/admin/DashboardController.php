<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
   public function dashboard(){

      return view('admin.dashboard');
   }

   public function dashboard_Content(){
      $user = User::get()->count();
      $category = JobCategory::get()->count();
      $job = job::get()->count();
      $AppliedJob = JobApplication::get()->count();
      
      return view('admin.dashboard_content', compact(['user','category','job','AppliedJob']));

   }
}
