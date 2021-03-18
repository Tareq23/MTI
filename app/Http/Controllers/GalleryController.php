<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageModel;

class GalleryController extends Controller
{
    public function uploadImageFile(Request $req)
    {
        $hostName = $_SERVER['HTTP_HOST'];
        $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;
        $imageFilePath = $req->file('image')->store('public/gallery');
        
        // return $imageFilePath;


        // $imagePath  = $req->file('image')->store('public');
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


        // $imgWebpFormat = '';
        // $path = storage_path('app\public');
        // if($imageFileName->extension() === 'jpg' || $imageFileName->extension() === 'jpeg')
        // {
        //     $img = imagecreatefromjpeg($imageFileName);
        //     imagepalettetotruecolor($img);
        //     imagealphablending($img,true);
        //     imagesavealpha($img,true);
        //     imagewebp($img,$path,60);
        // }
        // else if($imageFileName->extension() === 'png')
        // {
        //     $img = @imagecreatefrompng($imageFileName);
        //     imagepalettetotruecolor($img);
        //     imagealphablending($img,true);
        //     imagesavealpha($img,true);
        //     imagewebp($img,store('public'),60);
        // }
        // else if($imageFileName->extension() === 'gif')
        // {
        //     $img = imagecreatefromgif($imageFileName);
        //     imagepalettetotruecolor($img);
        //     imagealphablending($img,true);
        //     imagesavealpha($img,true);
        //     imagewebp($img,$imgWebpFormat,60);
        // }
        // else {
        //     return $imageFileName->extension();
        // }
        
        // return "Okk";
        // $imgWebpFormat->store('public');

        // // $imagePath  = $req->file('image')->store('public');
        // // $imageExtension = explode('.',$imageFileName);
        // // $imageExtension = end($imageExtension);
        // // return $imageExtension;
        // return $imagePath;
    }

    public function getTopEightImageUlr()
    {
        return ImageModel::take(8)->get();
    }
    public function loadMoreGalleryImage(Request $req)
    {
        $id = $req->input('id');
        $result = ImageModel::where('id','>',$id)->take(4)->get();
        return $result;
    }
}
