<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function getCategory()
    {
        return CategoryModel::all();
    }
    public function check(Request $req)
    {
        $name = $req->input('name');
        $count = CategoryModel::where('name','=',$name)->count();
        return $count;
    }
    public function addCategory(Request $req)
    {
        $name = $req->input('name');
        $result = CategoryModel::create(['name'=>$name]);
        return $result;
    }
    public function show()
    {
        return CategoryModel::orderBy('id','desc')->get();
    }
    public function delete(Request $req)
    {
        $id = $req->input('id');
        $result = CategoryModel::where('id','=',$id)->delete();
        return $result;
    }
    public function update(Request $req)
    {
        $id = $req->input('id');
        $name = $req->input('name');
        $result = CategoryModel::where('id','=',$id)->update(['name'=>$name]);
        return $result;
    }
}
