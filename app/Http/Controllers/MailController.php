<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailVerifiedTokenModel;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ResetPasswordModel;
use DB;
use App\Models\PostModel;
class MailController extends Controller
{
    public function confirmEmail($token)
    { 
        $length = strlen($token);
        if($length<40||$length>90||$token=='post')
        {
            return view('not_found');
        }
        try{
            $token = EmailVerifiedTokenModel::where('token','=',$token)->first();
            if(is_null($token))
            {
                return view('not_found');
            }
            $token->user()->update(['verified' => 1]);
            $roleId = RoleModel::select(['id'])->where('name','=','subscriber')->first();
            $userId = $token->user_id;
            $user = UserModel::find($userId);
            $user->roles()->attach($roleId);
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return view('not_found');
        }
    }
    public function resetPassword($token,$email)
    {
        try{
            $result = ResetPasswordModel::where('token','=',$token)->count();
            if($result)
            {
                $data = DB::table('home_page')->where('id','=',1)->get();
                $post = PostModel::select(['title','slug'])->where('verified','=',1)->take(6)->get();
                $all_posts = DB::table('posts')
                            ->join('users','users.id','=','posts.user_id')
                            ->select('users.name as name','posts.*')
                            ->where('posts.verified','=',1)
                            ->get();
                return view('blog',['reset_password'=>true,'email'=>$email,'data'=>$data,'posts'=>$post,'all_posts'=>$all_posts]);
            }
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
