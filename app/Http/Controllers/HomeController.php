<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PostModel;
use App\Models\TechnologyModel;
use App\Models\ProfileModel;
use App\Models\ProjectModel;
class HomeController extends Controller
{
    public function homeIndex()
    {
        try{
            $data = DB::table('home_page')->where('id','=',1)->get();
            $post = PostModel::select(['title','slug'])->where('verified','=',1)->take(6)->get();
            $technologies = TechnologyModel::all();
            $team_members = ProfileModel::where('confirm','=',1)->get();
            $projects = ProjectModel::where('confirm','=',1)->get();
            return view('home',[
                'data'=> $data,
                'posts'=>$post,
                'technologies' => $technologies,
                'team_members' => $team_members,
                'projects' => $projects,
            ]);
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function imageUpdate(Request $req)
    {
        try{
            $hostName = $_SERVER['HTTP_HOST'];
            $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;
            $current_image_url = explode('/',$req->input('current_image_url'));
            if($current_image_url[count($current_image_url)-2]!=="default"){
                Storage::disk('public')->delete($current_image_url[count($current_image_url)-2]."/".$current_image_url[count($current_image_url)-1]);
                // return $current_image_url[count($current_image_url)-2]."/".$current_image_url[count($current_image_url)-1];
            }
            $imageFilePath = $req->file('update_image')->store('public/gallery');
            $imgName = (explode('/',$imageFilePath));
            $location = $http."/"."storage";
            for($idx=1;$idx<count($imgName);$idx++)
            {
                $location .= "/" . $imgName[$idx] ;
            }
            //$user->profile()->update(['image'=>$location]);
            DB::table('home_page')->where('id','=',1)->update(['image'=>$location]);
            return 200;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function create(Request $req)
    {
        $data = DB::table('home_page')->where('id','>=',1)->count();
        if($data)
        {
            return 404;
        }
        try{
            $name = $req->input('name');
            $location = $req->input('location');
            $work_position = $req->input('work_position');
            $short_description = $req->input('short_desc');
            $footer = $req->input('footer_desc');
            $result = DB::table('home_page')->insert([
                'name' => $name,
                'map_link' => $location,
                'work_position' => $work_position,
                'image' => '/images/default/user.png',
                'short_description' => $short_description,
                'footer' => $footer,
            ]);
            return 200;
        }
        catch(\Exception $e)
        {
            return 404;
        }
    }
    public function update(Request $req)
    {
        try{
            $name = $req->input('name');
            $location = $req->input('location');
            $work_position = $req->input('work_position');
            $short_description = $req->input('short_desc');
            $footer = $req->input('footer_desc');
            $result = DB::table('home_page')->where('id','>=',1)->update([
                    'name' => $name,
                    'map_link' => $location,
                    'work_position' => $work_position,
                    'short_description' => $short_description,
                    'footer' => $footer,
                ]);

                return 200;
            }
            catch(\Exception $e)
            {
                return 404;
            }
    }
    public function get()
    {
        try{
            return DB::table('home_page')->where('id','=','1')->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
