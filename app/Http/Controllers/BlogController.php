<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use DB;
class BlogController extends Controller
{
    public function blogIndex()
    {
        try{

            $data = DB::table('home_page')->where('id','=',1)->get();
            $post = PostModel::select(['title','slug'])->where('verified','=',1)->take(6)->get();
            $all_posts = DB::table('posts')
                        ->join('users','users.id','=','posts.user_id')
                        ->select('users.name as name','posts.*')
                        ->where('posts.verified','=',1)
                        ->get();
            return view('blog',['data'=>$data,'posts'=>$post,'all_posts'=>$all_posts]);
        }
        catch(\Exception $e){
            return view('blog',['data'=>[],'posts'=>[],'all_posts'=>[]]);
        }
    }

    public function singlePostView($slug)
    {
        try{
            $data = DB::table('home_page')->where('id','=',1)->get();
            $posts = PostModel::select(['title','slug'])->where('verified','=',1)->take(6)->get();
            $post = PostModel::select(['title','id','views','content'])->where('slug','=',$slug)->first();
            if($post){
                PostModel::where('id','=',$post->id)->update(['views' => $post->views + 1]);
                return view('post',[
                    'data'=>$data,
                    'posts'=>$posts,
                    'title'=>$post->title,
                    'content'=>json_decode($post->content),
                ]);
            }
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        return view('not_found');
    }
}
