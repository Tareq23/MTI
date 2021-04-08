<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TechnologyModel;
class TechnologyController extends Controller
{
    public function store(Request $req)
    {
        try{
            $name = $req->input('technology_name');
            return TechnologyModel::create(['name'=>$name]);
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function delete(Request $req)
    {
        try{
            $id = $req->input('technology_id');
            return TechnologyModel::where('id','=',$id)->delete();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
    public function getAllForAdmin()
    {
        try{
            return TechnologyModel::all();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
