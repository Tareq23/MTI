<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function store(Request $req)
    {
        $name = $req->input('name');
        $email = $req->input('email');
        $subject = $req->input('subject');
        $message = $req->input('message');
        $contact = ContactModel::create([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ]);
        return $contact;
    }
    public function getContactAll()
    {
        return ContactModel::select(['name','email','subject','id'])->get();
    }
    public function getMessage($id)
    {
        return ContactModel::select('message')->where('id','=',$id)->first();
    }
    public function contactDelete(Request $req)
    {
        $id = $req->input('id');
        return ContactModel::where('id','=',$id)->delete();
    }
}
