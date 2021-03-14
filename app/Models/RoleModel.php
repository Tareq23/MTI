<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class RoleModel extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->belongsToMany(UserModel::class,'user_roles','role_id','user_id');
    }
}
