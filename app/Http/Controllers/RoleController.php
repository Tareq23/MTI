<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\UserModel;

class RoleController extends Controller
{
    public function allRole()
    {
        $result = RoleModel::select(['name','id'])->get();
        return $result;
    }
    public function indexRole()
    {
        return view('admin.role');
    }
    public function addRole(Request $req)
    {
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
    public function getRole(Request $req)
    {
        $id = $req->input('id');
        $user = UserModel::find($id);
        return $user->roles;
    }
    public function setUserRole(Request $req)
    {
        $userId = $req->input('id');
        $updateRole = $req->input('updateRole');
        $currentRole = $req->input('currentRole');
        $updateRoleArray = explode(',',$updateRole);
        $currentRoleArray = explode(',',$currentRole);
        $user = UserModel::find($userId);
        $user->roles()->detach($currentRoleArray);
        // $user->profile()->create([
        //     'name' => $user->name,
        //     'email' => $user->email,
        //     'image' => 'images/default/user.png',
        // ]);
        $user->roles()->attach($updateRoleArray);
        if(!$user->profile()->count()){
            $user->profile()->create([
                'name' => $user->name,
                'email' => $user->email,
                'image' => 'images/default/user.png',
            ]);
        }
        // foreach($user->roles()->id as $role_id)
        // {
        //     return 1;
        //     if($role_name=='admin'||$role_name=='teamMember')
        //     {
        //         if(!$user->profile()->where('user_id','=',$userId)->count())
        //         {
        //             $user->profile()->create([
        //                 'name' => $user->name,
        //                 'email' => $user->email,
        //                 'image' => 'images/default/user.png',
        //             ]);
        //         }
        //     }
        // }
        return 1;
    }
}
