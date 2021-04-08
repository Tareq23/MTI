<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Events\UserRegister;
use App\Models\EmailVerifiedTokenModel;
use Token;
use App\Mail\EmailVerifiedMail;
use Mail;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;
class UserController extends Controller
{
    public function getUser($id)
    {
        try{
            return UserModel::where('id',$id)->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    
    public function register(Request $req)
    {
        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];
        try{
            $user = UserModel::create($data);
            $token = Token::UniqueString('verified_tokens','token',90);
            try{
                $result = $user->emailVerifiedTokenId()->create(['token'=>$token]);
                if(isset($result->id))
                {
                    \Mail::to($user->email)->send(new EmailVerifiedMail($token));
                }
                return isset($result->id);
            }
            catch(\Exception $e)
            {
                return 404;
            } 
        }
        catch(\Exception $e)
        {
            return 0;
        }
    }
    public function login(Request $req)
    {
        try{
            $email = $req->input('email');
            $password = $req->input('password');
            $user = UserModel::select(['password','verified','id'])->where('email','=',$email)->get();
            if(Hash::check($password,$user[0]->password) && $user[0]->verified){
                session()->put('userId',$user[0]->id);
                $userAgain = UserModel::find($user[0]->id);
                foreach($userAgain->roles as $role)
                { 
                    session()->put($role->name,$role->name);
                }
                if(session()->has('teamMember'))
                {
                    return 'users';
                }
                return 'blog';
            }
            return false;
        }
        catch(\Exception $e)
        {
            // return redirect('/');
            return 404;
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function checkEmail(Request $req)
    {
        $email = $req->input('email');
        try{
            $result = UserModel::where('email','=',$email)->count();
            return $result;
        }
        catch(\Exception $e){
            return 0;
        }
    }
    public function getNotification()
    {
        try{
            $userId = session()->get('userId');
            DB::table('user_notifications')->where('user_id','=',$userId)->where('is_read','=',0)->update(['is_read'=>true]);
            $notify = DB::table('user_notifications as un')
                        ->join('users as u','u.id','=','un.user_id')
                        ->join('notifications as n','n.id','=','un.notification_id')
                        ->orderBy('un.id','desc')
                        ->select(['n.data','u.name'])
                        ->where('un.user_id','=',$userId)
                        ->get();
            return $notify;
        }
        catch(\Exception $e)
        {
            return 0;
        }
    }
    public function resetToken(Request $req)
    {
        try{
            $email = $req->input('email');
            $user = UserModel::where('email','=',$email)->get();
            if(!count($user))
            {
                return 404;
            }
            $token = $token = Token::UniqueString('reset_passwords','token',90);
            $user[0]->password_reset()->create([
                'token' => $token,
            ]);
            Notification::route('mail',$user[0]->email)
                ->notify(new ResetPasswordNotification([$token,$user[0]->email]));
            return 200;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function newpassword(Request $req)
    {
        $password = $req->input('password');
        $email = $req->input('email');
        try{
            $user = UserModel::where('email','=',$email)->get();
            $user[0]->password_reset()->delete();
            $user[0]->password = Hash::make($password);
            $user[0]->verified=1;           
            $user[0]->save(); 
            return 1;
        }
        catch(\Exception $e)
        {
            return 404;
        }
    }
}
