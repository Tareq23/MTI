<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
class NotificationModel extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'data'
    ];

    // protected $dispatchesEvents = [
    //     'created' => 
    // ];

    public function users()
    {
        return $this->belongsToMany(UserModel::class,'user_notifications','notification_id','user_id');
    }
}
