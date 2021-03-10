<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailVerifiedTokenModel;
// use App\Models\UserModel;

class MailController extends Controller
{
    public function confirmEmail($token)
    {   
        $token = EmailVerifiedTokenModel::where('token','=',$token)->first();
        $token->user()->update(['verified' => 1]);
        return redirect('/blog');
    }
}
