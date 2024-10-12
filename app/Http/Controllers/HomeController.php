<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\TeamMember;
use App\Models\JobCategory;
use App\Models\JobTypetime;
use Illuminate\Http\Request;

class HomeController extends Controller
{

  // This Method Will Show Home Page

   public function home(){
     
     $category = JobCategory::where('status',1)->orderBy('jobName','asc')->take(8)->get();

     $jobCategories = JobCategory::where('status',1)->orderBy('jobName','asc')->get();

     $feturedJob = job::where('status',1)
                  ->with(['JobCategory','JobTypetime'])
                  ->orderBy('created_at','desc')
                  ->where('isFeatured',1)
                  ->paginate(6);
                  
     $TeamMembers = TeamMember::get();
                  
     return view("fronted.home",compact(['category','feturedJob','jobCategories','TeamMembers']));
   }


}