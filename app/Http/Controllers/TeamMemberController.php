<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
class TeamMemberController extends Controller
{
    public function index()
    {
        $userId = session()->get('userId');
        $user = UserModel::find($userId);
        $notify = $user->notifications()->where('is_read','=',0)->count();
        return view('users.home',['notify'=>$notify]);
    }
}
