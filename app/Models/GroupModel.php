<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class GroupModel extends Model
{
    use HasFactory;
    protected $table='groups';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    // public function users()
    // {
    //     return belongsToMany(UserModel::class,'user_groups','group_id','user_id');
    // }

}
