<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class EmailVerifiedTokenModel extends Model
{
    use HasFactory;
    protected $table='verified_tokens';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'token','user_id'
    ];
    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }

}
