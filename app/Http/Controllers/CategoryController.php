<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function getCategory()
    {
        try{
            if(session()->has('userId'))
            {
                return CategoryModel::all();
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function check(Request $req)
    {
        try{
            $name = $req->input('name');
            $count = CategoryModel::where('name','=',$name)->count();
            return $count;
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function addCategory(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                $name = $req->input('name');
                $result = CategoryModel::create(['name'=>$name]);
                return $result;
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function show()
    {
        try{
            return CategoryModel::orderBy('id','desc')->get();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function delete(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                return redirect('/');
                $id = $req->input('id');
                $result = CategoryModel::where('id','=',$id)->delete();
                return $result;
            }
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function update(Request $req)
    {
        try{
            if(session()->has('userId'))
            {
                $id = $req->input('id');
                $name = $req->input('name');
                $result = CategoryModel::where('id','=',$id)->update(['name'=>$name]);
                return $result;
            }
            return redirect('/');
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
