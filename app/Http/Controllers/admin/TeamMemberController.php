<?php

namespace App\Http\Controllers\admin;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class TeamMemberController extends Controller
{
   public function TeamMemberShow(){
      $teamMembers = TeamMember::paginate(2);

      return view('admin.job.team_member', compact('teamMembers'));
   }

   public function AddTeamMember(Request $request){
      $validation = Validator::make($request->all(),[
         "name" => "required",
         "title" => "required",
         "bio" =>  "required",
         "member_img" => "required|image|mimes:png,jpg,jpeg,webp,jfif",
      ]);  

      if($validation->passes()){
        
        if($request->hasFile('member_img')){
           $file = $request->file('member_img');
           $fileName = time().'-'.$file->getClientOriginalName();
           $file = $file->move(public_path('assets/admin-panel/team_Member_img/'),$fileName);

           // Create a small Thubnail
           $sourcePath = public_path('assets/admin-panel/team_Member_img/'.$fileName);
           $manager = new ImageManager(Driver::class);
           $image = $manager->read($sourcePath);

           // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
           $image->cover(150, 150);
           $image->toPng()->save(public_path('assets/admin-panel/team_Member_img/thumb/'.$fileName));

           TeamMember::create([
              "name" => $request->name,
              "title" => $request->title,
              "bio" => $request->bio,
              "member_img" => $fileName
           ]);

           session()->flash('success','Team Member Added Successfully.');

           return response()->json([
              "status" => true
           ]);
        }

      }else{
        return response()->json([
            "status" => false,
            "errors" => $validation->errors(),
        ]);
      }
   }

    //*Delete Team Member
    public function DeleteTeamMember(Request $request){
      
      $delete = TeamMember::find($request->id);
       
      //Delete Image In Folder
      File::delete(public_path('/assets/admin-panel/team_Member_Img/').$delete->member_img);
      File::delete(public_path('/assets/admin-panel/team_Member_Img/thumb/').$delete->member_img);

      $delete->delete();

      session()->flash('success','Team Member Deleted Successfully');

    }    

    //*  Team Member Show Update Form
    public function EditTeamMember(string $id){
        
        $data = TeamMember::find($id);
        return view('admin.job.update_team_Member',compact('data'));
    }

    //* This Method Will Update Team Member Data
    public function UpdateTeamMember(Request $request, string $id){
        $validation = Validator::make($request->all(),[
           "name" => "required",
           "title" => "required",
           "bio" => "required",
           "member_img" => "required"
        ]); 

        if($validation->passes()){

            $id = TeamMember::find($id);

            // update Member Img 
            if($request->hasFile('member_img')){
               $file = $request->file('member_img');
               $fileName = time().'-'.$file->getClientOriginalName();
               $file = $file->move(public_path('assets/admin-panel/team_Member_img/'),$fileName);

               // Create a small Thubnail
               $sourcePath = public_path('assets/admin-panel/team_Member_img/'.$fileName);
               $manager = new ImageManager(Driver::class);
               $image = $manager->read($sourcePath);
 
               // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
               $image->cover(150, 150);
               $image->toPng()->save(public_path('assets/admin-panel/team_Member_img/thumb/'.$fileName));

               //Delete Image In Folder
               File::delete(public_path('/assets/admin-panel/team_Member_Img/').$id->member_img);
               File::delete(public_path('/assets/admin-panel/team_Member_Img/thumb/').$id->member_img);

               $id->update([
                  "name" => $request->name,
                  "title" => $request->title,
                  "bio" => $request->bio,
                  "member_img" => $fileName
               ]);

               session()->flash('success','Data Updated Successfully.');

               return response()->json([
                   'status' => true
               ]);
            }
            
        }else{
            return response()->json([
               'status' => false,
               "errors" => $validation->errors()
            ]);
        }
    } 



}
