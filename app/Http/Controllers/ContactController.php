<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function ContactIndex(){
       return view('fronted.contact');
    }

    //* This Method Will Add New Comment
    public function CreateContact(Request $request){
        $validator = Validator::make($request->all(),[
             "message" => "required|max:300",
             "name" => "required",
             "email" => "required|email",
             "subject" => "required" 
        ]);

        if($validator->passes()){
            Contact::create([
               'message' => $request->message,
               'user_id' => Auth::user()->id,
               'name' => $request->name,
               'email' => $request->email,
               'subject' => $request->subject
            ]);

            session()->flash('sucess','Contact Message Successfully Sent.');

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
}
