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
use App\Models\CategoryModel;

class PostController extends Controller
{
    // private $tags;
    private function addTags($name)
    {
        try{
            $result = TagModel::firstOrCreate(['name'=>$name]);
            return $result->id;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function create(Request $req)
    {
        try{

            $content = [
                'image' => $req->input('url'),
                'text' => $req->input('content'),
            ];
            $title = $req->input('title');
            $category_id = $req->input('category');
            $userId = session()->get('userId');
            
            if($userId){
                $slug_token = Token::UniqueString('posts','slug',40);
                $post = PostModel::create([
                    'user_id'=>$userId,
                    'category_id'=>$category_id,
                    'title' => $title,
                    'slug' => $slug_token,
                    'content' => json_encode($content),
                    'time' => date_default_timezone_set("UTC").time(),
                ]);
                
                
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
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getUserPost()
    {
        try{
            $userId = session()->get('userId');
            if($userId){
                $userPost = UserModel::find($userId);
                return $userPost->posts;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getAllPost()
    {
        try{
            return PostModel::all();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function categoryPost(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                $id = $req->input('id');
                $category = CategoryModel::find($id);
                return $category->posts;
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function postVerified(Request $req)
    {
        try{
            $id = $req->input('id');
            $verified_value = $req->input('value');
            // $post = PostModel::where('id','=',$id)->update(['verified'=> $verified_value]);
            $post = PostModel::find($id);
            $tags = explode(' ',$post->title);
            $tagsId = [];
            foreach($tags as $tag)
            {
                if(strlen($tag)>2){
                    array_push($tagsId,$this->addTags($tag));
                }
            }
            $post->tags()->attach($tagsId);
            $post->verified = $verified_value;
            $post->save();
            // PostModifiedEvent
            event(new PostModifiedEvent($post));
            return 1;
        }
        catch(\Exception $e){
            return 0;
        }
    }
    public function singlePostShow(Request $req)
    {
        try{
            $id = $req->input('id');
            return PostModel::select('content')->where('id','=',$id)->first();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function deletePost(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                $id = $req->input('id');
                $result = PostModel::where('id','=',$id)->delete();
                return $result;
            }
            return redirect('/');
        }   
        catch(\Exception $e)
        {
            return 0;
        }
    }
}
