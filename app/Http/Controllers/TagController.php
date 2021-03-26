<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TagModel;

class TagController extends Controller
{
    public function addTag(Request $req)
    {
        $name = $req->input('name');
        $result = TagModel::firstOrCreate(['name'=>$name]);
        return $result;
    }
    public function showTag()
    {
        return TagModel::orderBy('id','desc')->limit(100)->get();
    }
}
