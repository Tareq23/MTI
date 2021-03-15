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
        if(strlen($role)<4&&strlen($role)>25){
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
    public function setRole(Request $req)
    {
        $userId = $req->input('id');
        $updateRole = $req->input('updateRole');
        $currentRole = $req->input('currentRole');
        $upateRoleArray = explode(',',$updateRole);
        $currentRoleArray = explode(',',$currentRole);
        $user = UserModel::find($userId);
        $user->roles()->detach($currentRoleArray);
        $user->roles()->attach($upateRoleArray);
        return 1;
    }
}
