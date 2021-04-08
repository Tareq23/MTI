<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TagModel;

class TagController extends Controller
{
    public function addTag(Request $req)
    {
        try{
            $name = $req->input('name');
            $result = TagModel::firstOrCreate(['name'=>$name]);
            return $result;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function showTag()
    {
        try{
            return TagModel::orderBy('id','desc')->limit(100)->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
