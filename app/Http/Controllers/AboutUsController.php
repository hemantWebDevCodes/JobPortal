<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    // Show Aboute Us Page
    public function AboutUs(){
        $TeamMembers = TeamMember::get();

        return view('fronted.about_us', compact('TeamMembers'));
     }
}
