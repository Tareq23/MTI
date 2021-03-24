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
        $userId = session()->get('userId',0);
        if($userId)
        {
            $user = UserModel::where('id','=',$userId)->first();
            return $user->profile;
        }
        return redirect('/blog');
    }
    public function nameUpdate(Request $req)
    {
        $userId = session()->get('userId',0);
        if($userId)
        {
            $user = UserModel::where('id','=',$userId)->first();
            return $user->profile;
        }
        return redirect('/blog');
    }
    public function educationUpdate(Request $req)
    {
        $userId = session()->get('userId',0);
        if($userId)
        {
            $user = UserModel::where('id','=',$userId)->first();
            $user->profile()->update(['education'=>$req->input('education')]);
            return $user->profile;
        }
        return redirect('/blog');
    }
    public function imageUpdate(Request $req)
    {
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
    public function socialLinkUpdate(Request $req)
    {
        $userId = session()->get('userId',0);
        if($userId)
        {
            $user = UserModel::where('id','=',$userId)->first();
            $user->profile()->update(['social_link'=>$req->input('social_link')]);
            return $user->profile;
        }
        return redirect('/blog');
    }
    public function descriptionUpdate(Request $req)
    {
        $userId = session()->get('userId',0);
        if($userId>0)
        {
            $user = UserModel::where('id','=',$userId)->first();
            $user->profile()->update(['description'=>$req->input('description')]);
            return $user->profile;
        }
        return redirect('/blog');
    }
}
