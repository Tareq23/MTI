<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
class BlogController extends Controller
{
    public function blogIndex()
    {
        return view('blog');
    }

    public function singlePostView($slug)
    {
        $result = PostModel::select(['title','id','views','content'])->where('slug','=',$slug)->first();
        if($result){
            PostModel::where('id','=',$result->id)->update(['views' => $result->views + 1]);
            return view('post',['post'=>$result]);
        }
        return view('not_found');
    }
}
