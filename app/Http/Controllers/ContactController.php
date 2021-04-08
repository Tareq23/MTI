<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function store(Request $req)
    {
        try{
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
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getContactAll()
    {
        try{

            return ContactModel::select(['name','email','subject','id'])->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getMessage($id)
    {
        try{
            return ContactModel::select('message')->where('id','=',$id)->first();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function contactDelete(Request $req)
    {
        try{
            $id = $req->input('id');
            return ContactModel::where('id','=',$id)->delete();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
