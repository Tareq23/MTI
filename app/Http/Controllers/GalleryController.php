<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageModel;

class GalleryController extends Controller
{
    public function uploadImageFile(Request $req)
    {
        try{
            $hostName = $_SERVER['HTTP_HOST'];
            $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;
            $imageFilePath = $req->file('image')->store('public/gallery');
            $imgName = (explode('/',$imageFilePath));
            $location = $http."/"."storage";
            for($idx=1;$idx<count($imgName);$idx++)
            {
                $location .= "/" . $imgName[$idx] ;
            }
            // return $location;
            $result = ImageModel::insert([
                'url' => $location,
            ]);
            if($result)
            {
                return $result;
            }
            return $result;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }

    public function getTopEightImageUlr()
    {
        try{
            return ImageModel::take(8)->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function loadMoreGalleryImage(Request $req)
    {
        try{
            $id = $req->input('id');
            $result = ImageModel::where('id','>',$id)->take(4)->get();
            return $result;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
