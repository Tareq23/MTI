<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
class RoleController extends Controller
{
    public function getRole()
    {
        $result = RoleModel::all();
        return $result;
    }
}
