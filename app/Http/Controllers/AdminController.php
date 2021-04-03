<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use DB;
class AdminController extends Controller
{
    public function adminProfile()
    {
        $adminId = session()->get('userId');
        // $admin = UserModel::find($adminId);
        $notify = DB::table('user_notifications')->where('user_id','=',$adminId)->where('is_read','=',0)->count();
        return view('admin.home',['notify'=>$notify]);
    }
    public function getAllVerifiedUser()
    {
        return UserModel::select(['id','email'])->where('verified','=',1)->get();
    }
    public function getNotification()
    {
        $adminId = session()->get('userId');
        DB::table('user_notifications')->where('user_id','=',$adminId)->update(['is_read'=>true]);
        $notify = DB::table('user_notifications as un')
                    ->join('users as u','u.id','=','un.user_id')
                    ->join('notifications as n','n.id','=','un.notification_id')
                    ->orderBy('un.id','desc')
                    ->select(['n.data','u.name'])
                    ->get();
        return $notify;
    }
}
