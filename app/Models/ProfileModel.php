<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class ProfileModel extends Model
{
    use HasFactory;
    protected $table='user_profiles';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    
    protected $fillable = [
        'name','user_id','email','education','social_link','description','image'
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
    // public function users()
    // {
    //     return $this->hasMany(UserModel::class,'user_id');
    // }
}
