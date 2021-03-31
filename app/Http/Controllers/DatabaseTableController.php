<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseTableController extends Controller
{
    public function getTable()
    {
        $tables = DB::select('SHOW TABLES');
        foreach($tables as $table)
        {
            echo $table->Tables_in_db_name;
        }
    }
}
