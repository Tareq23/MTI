<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table='projects';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name','url','user_id','image','confirm'
    ];
    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
