<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagModel;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\NotificationModel;
use Token;
use DB;
use App\Events\PostModifiedEvent;
use App\Events\PostCreateEvent;

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
            
            
            $admin_role = RoleModel::select('id')->where('name','=','admin')->first();
            $admin = DB::table('user_roles')->where('role_id','=',$admin_role->id)->first();
            $current_user = UserModel::findOrFail($userId);
            $data = [
                'type' => 'post',
                'details' => $post,
                'created_by' => $current_user->name,
            ];
            $notify = NotificationModel::create(['data'=>json_encode($data)]);
            $notify->users()->attach($admin->user_id);
            event(new PostCreateEvent($data));
            

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
