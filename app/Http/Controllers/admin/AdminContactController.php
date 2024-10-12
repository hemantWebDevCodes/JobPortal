<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    
    // This Method Will Show Contact List
    public function ContactShow(){
        $contacts = Contact::paginate(6);
        return view('admin.users.contactList', compact('contacts'));
    }
    
    // This Method Will Remove Contact
    public function RemoveContact(Request $request){
        $id = $request->id;

        $removeContact = Contact::findOrFail($id);

        if($removeContact == null){
            session()->flash('error','Remove Not Found.');
            return response()->json([
              'status' => false
            ]);

        }

        $removeContact->delete();

        session()->flash('success','Contact Removed Successfully.');
    }
}
