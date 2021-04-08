<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\ProfileModel;
use DB;
class RoleController extends Controller
{
    public function allRole()
    {
        try{
            $result = RoleModel::select(['name','id'])->get();
            return $result;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function indexRole()
    {
        return view('admin.role');
    }
    public function addRole(Request $req)
    {
        try{

            $role = trim($req->input('name'));
            if(strlen($role)<4 || strlen($role)>25){
                return 4;
            }
            if(RoleModel::where('name','=',$role)->count())
            {
                return 0;
            }
            $result = RoleModel::insert(['name'=>$role]);
            return $result;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getRole(Request $req)
    {
        try{
            $id = $req->input('id');
            $user = UserModel::find($id);
            return $user->roles;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function setUserRole(Request $req)
    {
        try{
            $userId = $req->input('id');
            $updateRole = $req->input('updateRole');
            $currentRole = $req->input('currentRole');
            $updateRoleArray = explode(',',$updateRole);
            $currentRoleArray = explode(',',$currentRole);
            $user = UserModel::find($userId);
            $user->roles()->detach($currentRoleArray);
            $user->roles()->attach($updateRoleArray);

            $roles = DB::table('user_roles as ur')
                ->join('users as u','u.id','=','ur.user_id')
                ->join('roles as r','r.id','=','ur.role_id')
                ->select('r.name')
                ->where('u.id','=',$userId)
                ->get();
            foreach($roles as $role){
                if($role->name == "teamMember")
                {
                    if(!ProfileModel::where('user_id','=',$userId)->count())
                    {
                        $profile = ProfileModel::create([
                            'user_id' => $user->id,
                            'email' => $user->email,
                            'name' => $user->name,
                            'image' => 'images/default/user.png',
                            'confirm'=>0,
                        ]);
                        return $profile;
                    }
                    return $role->name;
                }
            }
            
            return 1;
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
