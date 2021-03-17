<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function uploadImageFile(Request $req)
    {
        $hostName = $_SERVER['HTTP_HOST'];
        $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;
        $imageFileName = $req->file('image')->store('public');
        return 1;
        $imgWebpFormat = '';
        $path = storage_path('app\public');
        if($imageFileName->extension() === 'jpg' || $imageFileName->extension() === 'jpeg')
        {
            $img = imagecreatefromjpeg($imageFileName);
            imagepalettetotruecolor($img);
            imagealphablending($img,true);
            imagesavealpha($img,true);
            imagewebp($img,$path,60);
        }
        else if($imageFileName->extension() === 'png')
        {
            $img = @imagecreatefrompng($imageFileName);
            imagepalettetotruecolor($img);
            imagealphablending($img,true);
            imagesavealpha($img,true);
            imagewebp($img,store('public'),60);
        }
        else if($imageFileName->extension() === 'gif')
        {
            $img = imagecreatefromgif($imageFileName);
            imagepalettetotruecolor($img);
            imagealphablending($img,true);
            imagesavealpha($img,true);
            imagewebp($img,$imgWebpFormat,60);
        }
        else {
            return $imageFileName->extension();
        }
        
        return "Okk";
        $imgWebpFormat->store('public');

        // $imagePath  = $req->file('image')->store('public');
        // $imageExtension = explode('.',$imageFileName);
        // $imageExtension = end($imageExtension);
        // return $imageExtension;
        return $imagePath;
    }
}
