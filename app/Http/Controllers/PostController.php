<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagModel;
use App\Models\PostModel;
use App\Models\UserModel;
use Token;

class PostController extends Controller
{
    // private $tags;
    private function addTags($name)
    {
        $result = TagModel::firstOrCreate(['name'=>$name]);
        return $result->id;
    }
    public function create(Request $req)
    {
        $content = $req->input('content');
        $title = $req->input('title');
        $tags = $req->input('tags');
        $category_id = $req->input('category');
        $userId = session()->get('userId');
        $tagsId = [];
        if($userId){
            //$user = UserModel::find($userId);
            foreach($tags as $tag)
            {
                array_push($tagsId,$this->addTags($tag));
            }
            $slug_token = Token::UniqueString('posts','slug',40);
            $post = PostModel::create([
                'user_id'=>$userId,
                'category_id'=>$category_id,
                'title' => $title,
                'slug' => $slug_token,
                'content' => $content,
                'time' => date_default_timezone_set("UTC").time(),
            ]);
            $post->tags()->attach($tagsId);
            return true;
        }
        return false;
    }
    public function getUserPost()
    {
        $userId = session()->get('userId');
        if($userId){
            $userPost = UserModel::find($userId);
            return $userPost->posts;
        }
        return redirect('/blog');
    }
}
