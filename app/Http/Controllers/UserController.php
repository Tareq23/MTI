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

class UserController extends Controller
{
    public function getUser($id)
    {
        return UserModel::where('id',$id)->get();
    }
    public function getAllVerifiedUser()
    {
        return UserModel::select(['id','email'])->where('verified','=',1)->get();
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
                return $e->getMessage();
            } 
        }
        catch(\Exception $e)
        {
            return 0;
        }
    }
    public function login(Request $req)
    {
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
            return true;
        }
        return false;
    }

    public function logout()
    {
        session()->flush();
        return 1;
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
}
