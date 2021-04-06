<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\EmailVerifiedTokenModel;
use App\Models\RoleModel;
use App\Events\UserRegister;
use App\Models\ProfileModel;
use App\Models\PostModel;
use App\Models\GroupModel;
use App\Models\ProjectModel;
use App\Models\NotificationModel;
use App\Models\ResetPasswordModel;
class UserModel extends Model
{
    use HasFactory;
    use Notifiable;
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
    public function password_reset()
    {
        return $this->hasOne(ResetPasswordModel::class,'user_id','id');
    }
    // public function profiles()
    // {
    //     return $this->hasOne(ProfileModel::class,'user_id','id');
    // }
    public function posts()
    {
        return $this->hasMany(PostModel::class,'user_id','id');
    }
    
    public function projects()
    {
        return $this->hasMany(ProjectModel::class,'user_id','id');
    }


    // public function groups()
    // {
    //     return $this->belongsToMany(GroupModel::class,'user_groups','user_id','group_id');
    // }

    public function notifications()
    {
        return $this->belongsToMany(NotificationModel::class,'user_notifications','user_id','notification_id');
    }

}
