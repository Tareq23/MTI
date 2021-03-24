<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class AdminController extends Controller
{
    public function userProfile()
    {
        return view('admin.home');
    }
    public function getAllVerifiedUser()
    {
        return UserModel::select(['id','email'])->where('verified','=',1)->get();
    }
}
