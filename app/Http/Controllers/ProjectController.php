<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    public function store(Request $req)
    {
        $userId = session()->get('userId',0);
        if($userId)
        {
            try{
                $user = UserModel::where('id','=',$userId)->first();
                $hostName = $_SERVER['HTTP_HOST'];
                $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;
                $imageFilePath = $req->file('project_image')->store('public/gallery');
                $imgName = (explode('/',$imageFilePath));
                $location = $http."/"."storage";
                for($idx=1;$idx<count($imgName);$idx++)
                {
                    $location .= "/" . $imgName[$idx] ;
                }
                $user->projects()->create(['image'=>$location,'name'=>$req->input('project_name'),'url'=>$req->input('project_url')]);
                return response()->json(
                    [
                     'status' => 200,
                     'success' => "Project Successfully Added",
                    ]
                 );
            }
            catch(\Exception $e)
            {
                return response()->json(
                   [
                    'status' => 404,
                    'error' => "Something went to wrong"
                   ]
                );
            }
        }
        return redirect('/blog');
    }
    public function showUserProejct()
    {
        try{
            if(session()->has('userId'))
            {
                $id = session()->get('userId');
                $user= UserModel::find($id);
                return $user->projects;
            }
            return redirect('/blog');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }

    public function getAllProject()
    {
        try{
            return ProjectModel::all();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function projectConfirm(Request $req)
    {
        try{
            $projectId = $req->input('projectId');
            $confirmValue = $req->input('confirmValue');
            // $user = UserModel::find($userId);
            // $user->projects()->update(['confirm'=>$confirmValue]);
            $project = ProjectModel::where('id','=',$projectId)->update(['confirm'=>$confirmValue]);
            return $project;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function projectDelete(Request $req)
    {
        try{
            $projectId = $req->input('id');
            return ProjectModel::where('id','=',$projectId)->delete();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
