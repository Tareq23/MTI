<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use DB;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function adminProfile()
    {
        try{
            $adminId = session()->get('userId');
            $notify = DB::table('user_notifications')->where('user_id','=',$adminId)->where('is_read','=',0)->count();
            return view('admin.home',['notify'=>$notify]);
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getAllVerifiedUser()
    {
        try{
            return UserModel::select(['id','email'])->where('verified','=',1)->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getNotification()
    {
        try{
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
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function changeEmailPassword(Request $req)
    {
        if(session()->has('admin'))
        {
            try{
                $email = $req->input('email');
                $password = $req->input('password');
                $userId =  session()->get('userId');
                $result = UserModel::where('id','=',$userId)->update([
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);
                return $result;
            }
            catch(\Exception $e)
            {
                return 404;
            }
        }
        return 404;
    }
}
