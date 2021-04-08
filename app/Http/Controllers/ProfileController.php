<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function getProfile()
    {
        try{
            $userId = session()->get('userId',0);
            if($userId)
            {
                $user = UserModel::where('id','=',$userId)->first();
                return $user->profile;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function nameUpdate(Request $req)
    {
        try{
            $userId = session()->get('userId',0);
            if($userId)
            {
                $user = UserModel::where('id','=',$userId)->first();
                return $user->profile;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function educationUpdate(Request $req)
    {
        try{
            $userId = session()->get('userId',0);
            if($userId)
            {
                $user = UserModel::where('id','=',$userId)->first();
                $user->profile()->update(['education'=>$req->input('education')]);
                return $user->profile;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function imageUpdate(Request $req)
    {
        try{
            $userId = session()->get('userId',0);
            if($userId)
            {
                $user = UserModel::where('id','=',$userId)->first();
                $hostName = $_SERVER['HTTP_HOST'];
                $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;
                $current_image_url = explode('/',$req->input('current_image_url'));
                if($current_image_url[count($current_image_url)-2]!=="default"){
                    Storage::disk('public')->delete($current_image_url[count($current_image_url)-2]."/".$current_image_url[count($current_image_url)-1]);
                    // return $current_image_url[count($current_image_url)-2]."/".$current_image_url[count($current_image_url)-1];
                }
                $imageFilePath = $req->file('profile_image')->store('public/gallery');
                $imgName = (explode('/',$imageFilePath));
                $location = $http."/"."storage";
                for($idx=1;$idx<count($imgName);$idx++)
                {
                    $location .= "/" . $imgName[$idx] ;
                }
                $user->profile()->update(['image'=>$location]);
                return $user;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function socialLinkUpdate(Request $req)
    {
        try{
            $userId = session()->get('userId',0);
            if($userId)
            {
                $user = UserModel::where('id','=',$userId)->first();
                $user->profile()->update(['social_link'=>$req->input('social_link')]);
                return $user->profile;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function descriptionUpdate(Request $req)
    {
        try{
            $userId = session()->get('userId',0);
            if($userId>0)
            {
                $user = UserModel::where('id','=',$userId)->first();
                $user->profile()->update(['description'=>$req->input('description')]);
                return $user->profile;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function usersProfile()
    {
        try{
            if(session()->has('userId'))
            {
                return ProfileModel::select(['id','name','image','priority_serial','social_link','confirm'])->get();
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function profileDetails(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                $id = $req->input('id');
                return ProfileModel::select(['social_link','description'])->where('id','=',$id)->first();
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function teamMemberConfirm(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                $id = $req->input('id');
                $value = $req->input('value');
                return ProfileModel::where('id','=',$id)->update(['confirm'=>!$value]);
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
