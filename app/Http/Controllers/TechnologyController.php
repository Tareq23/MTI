<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TechnologyModel;
class TechnologyController extends Controller
{
    public function store(Request $req)
    {
        $name = $req->input('technology_name');
        return TechnologyModel::create(['name'=>$name]);
    }
    public function delete(Request $req)
    {
        $id = $req->input('technology_id');
        return TechnologyModel::where('id','=',$id)->delete();
    }
    public function getAllForAdmin()
    {
        return TechnologyModel::all();
    }
}
