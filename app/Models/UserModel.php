<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmailVerifiedTokenModel;
use App\Models\RoleModel;
use App\Events\UserRegister;
use App\Models\ProfileModel;

class UserModel extends Model
{
    use HasFactory;
    protected $table='users';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // protected $hidden = ['password','verified'];

    //Event for new user registration
    // protected $dispatchesEvents = [
    //     'created' => UserRegister::class,
    // ];


    public function emailVerifiedTokenId()
    {
        return $this->hasOne(EmailVerifiedTokenModel::class,'user_id');
    }
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class,'user_roles','user_id','role_id');
    }
    public function profile()
    {
        // return $this->belongsTo(User::class)
        return $this->hasOne(ProfileModel::class,'user_id','id');
    }
    
}
