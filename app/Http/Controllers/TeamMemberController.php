<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
class TeamMemberController extends Controller
{
    public function index()
    {
        try{
            if(session()->has('userId')){
                $userId = session()->get('userId');
                $user = UserModel::find($userId);
                $notify = $user->notifications()->where('is_read','=',0)->count();
                return view('users.home',['notify'=>$notify]);
            }
            else{
                return redirect('/');
            }
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
